<?php

namespace App\Http\Livewire;

use App\Models\Rapport;
use App\Models\Tournee;
use App\Models\Transfert;
use App\Models\User;
use Livewire\Component;

class DashComponent extends Component
{
    public $totalCompletedTournees;

    public $totalActiveTournees;

    public $userTypeDistribution;

    public $tourneeStateDistribution;

    public $popularDaysForTournees;

    public $mostVisitedLocations;

    public $totalWrittenReports;

    public $reportsByTourneeState;

    public $totalTransfersMade;

    public $commonPeriodsForTransfers;

    public $totalTournees;

    public $totalUsers;

    public $chartOptions;

    public $barchartcomparingthenumberofusersofeachtypeforvantetretriersoveroneyearonemonthoneweekoneday;

    public $barchartdistributionofreportsbystateofthetournee;

    public $barchartdistributionofthetoursperinspectorandthetourduration;

    public $barchartrepresentingtheevolutionofthetotalnumberoftoursovertime;

    public $piechartcomparingthesexedistributionofusers;

    public $chartForAverageReportCompletionTimePerInspector;

    public $chartForReportSignatureStatusDistribution;

    public function mount()
    {
        $this->fetchData();
        $this->dataGraph();
        $this->dataCalendar('tournées');
        // dump($this->dataGraph());
        // dump('dataCalendar dataCalendar dataCalendar dataCalendar dataCalendar dataCalendar dataCalendar dataCalendar dataCalendar');
        // dump($this->dataCalendar('tournées', now()->subDays(7)));
        // dump('all dd all dd all dd all dd all dd all dd all dd all dd all dd all dd all dd all dd all dd all dd all dd all dd all dd');
        // dd($this->popularDaysForTournees, $this->mostVisitedLocations, $this->reportsByTourneeState, $this->commonPeriodsForTransfers, $this->tourneeStateDistribution, $this->userTypeDistribution, $this->totalUsers, $this->totalTournees, $this->totalCompletedTournees, $this->totalActiveTournees, $this->totalWrittenReports, $this->totalTransfersMade);
    }

    private function fetchData()
    {
        $this->userTypeDistribution = User::query()->groupBy('type')->count();

        $this->totalUsers = User::query()->count();

        $this->totalTournees = Tournee::query()->count();

        $this->totalCompletedTournees = Tournee::query()->where('date', '>', now()->subDays(7))->where('date', '<', now()->addDay())->where('etat', 'Effectuer')->count();

        $this->totalActiveTournees = Tournee::query()->where('date', '>', now()->subDays(7))->where('date', '<', now()->addDay())->where('etat', 'En cours')->count();

        $this->tourneeStateDistribution = Tournee::query()->groupBy('etat')->count();

        $this->popularDaysForTournees = Tournee::query()->select('date')->groupBy('date')->orderByRaw('count(*) desc')->value('date');

        $this->mostVisitedLocations = Tournee::query()->select('adresse_complet')->groupBy('adresse_complet')->orderByRaw('count(*) desc')->value('adresse_complet');

        $this->totalWrittenReports = Rapport::query()->count();

        $this->reportsByTourneeState = Rapport::query()->join('tournees', 'tournees.id', '=', 'rapports.tournee_id')->groupBy('tournees.etat')->count();

        $this->totalTransfersMade = Transfert::query()->count();

        $this->commonPeriodsForTransfers = Transfert::query()->select('date_debut', 'date_fin')->groupBy('date_debut', 'date_fin')->orderBy('date_debut', 'desc')->value('date_debut');
    }

    public function dataGraph()
    {

        $this->barchartcomparingthenumberofusersofeachtypeforvantetretriersoveroneyearonemonthoneweekoneday = User::selectRaw('type, sexe, count(*) as count')->groupBy('type', 'sexe')->get()->toArray();

        $this->barchartdistributionofreportsbystateofthetournee = Tournee::selectRaw('etat, date, count(*) as count')->groupBy('etat', 'date')->get()->toArray();

        $this->barchartdistributionofthetoursperinspectorandthetourduration = Tournee::selectRaw('inspecteur_id, count(*) as count, AVG(TIMESTAMPDIFF(MINUTE, date, tournees.updated_at)) as avg_duration')->groupBy('inspecteur_id')->join('users', 'tournees.inspecteur_id', '=', 'users.id')->get(['users.nom'])->toArray();

        $this->barchartrepresentingtheevolutionofthetotalnumberoftoursovertime = Tournee::selectRaw('DATE(date) as date, count(*) as count')->where('date', '>=', now()->subWeek())->groupBy('date')->orderBy('date')->get()->toArray();

        $this->piechartcomparingthesexedistributionofusers = User::selectRaw('sexe, count(*) as count')->groupBy('sexe')->get()->toArray();

        $this->chartForAverageReportCompletionTimePerInspector = Tournee::selectRaw('users.nom, count(*) as count, AVG(TIMESTAMPDIFF(MINUTE, tournees.date, rapports.created_at)) as avg_completion_time')->groupBy('tournees.inspecteur_id')->join('users', 'tournees.inspecteur_id', '=', 'users.id')->join('rapports', 'tournees.id', '=', 'rapports.tournee_id')->get(['users.nom'])->toArray();

        $this->chartForReportSignatureStatusDistribution = Rapport::selectRaw('signature, count(*) as count')->groupBy('signature')->get()->toArray();

    }

    public function dataCalendar(string $filter, ?\DateTime $date = null): array
    {

        switch ($filter) {

            case 'tournées':

                $query = Tournee::query();
                break;

            case 'rapports':

                $query = Rapport::whereNull('signature');
                break;

            case 'disponibilités':

                $query = Transfert::query();

                if ($date) {
                    $query->where(function ($subquery) use ($date) {
                        $subquery->whereDate('date_debut', '<=', $date)
                            ->whereDate('date_fin', '>=', $date)
                            ->orWhereDate('date_debut', $date)
                            ->orWhereDate('date_fin', $date);
                    });
                }
                break;

            case 'transferts':

                $query = Transfert::where('status', 'en_cours');
                break;

            default:

                throw new \InvalidArgumentException("Invalid filter: $filter");
        }

        if ($date) {
            $query->whereDate('created_at', '>=', $date->format('Y-m-d'));
        }

        return $query ? $query->get()->toArray() : [];
    }

    public function render()
    {
        return view('livewire.dash-component');
    }
}
