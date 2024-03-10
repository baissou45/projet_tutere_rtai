<?php

namespace App\Http\Livewire;

use App\Models\Rapport;
use App\Models\Tournee;
use App\Models\Transfert;
use App\Models\User;
use Livewire\Component;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Rule;

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

    public $selectType = '';

    public $userChoiceselectType = 'tout';

    public $chartOptions;

    public $barchartcomparingthenumberofusersofeachtypeforvantetretriersoveroneyearonemonthoneweekoneday;

    public $barchartdistributionofreportsbystateofthetournee;

    public $barchartdistributionofthetoursperinspectorandthetourduration;

    public $barchartrepresentingtheevolutionofthetotalnumberoftoursovertime;

    public $piechartcomparingthesexedistributionofusers;

    public $chartForAverageReportCompletionTimePsécretaireerInspector;

    public $chartForReportSignatureStatusDistribution;

    public $chartForAverageReportCompletionTimePerInspector;

    public $choix1 = 'tout';

    public $choix2 = 'mois';


    public function mount()
    {
        $this->fetchData();
        $this->dataGraph();
        $this->updateSexDistributionChart($this->userChoiceselectType);
        $this->selectType('tout');
        $this->dataCalendar('tournées');
        $this->histogramoftourdistributionbyinspectorandtourdurationhistogramoftotalnumberofroundsovertime(null, null);
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

        // dump($this->piechartcomparingthesexedistributionofusers);
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

    public function selectType($type)
    {
        $this->userChoiceselectType = $type;
        $this->updateSexDistributionChart($type);
        $this->emit('typeChanged', $type); // Émettre un événement Livewire lorsque le type change
    }

    public function updateSexDistributionChart($userChoiceselectType)
    {
        $seriesName = [];
        $seriesData = [];

        $query = User::selectRaw('sexe, count(*) as count')
            ->when($userChoiceselectType !== 'tout', function ($query) use ($userChoiceselectType) {
                return $query->where('type', $userChoiceselectType);
            })
            ->groupBy('sexe')
            ->get()
            ->toArray();

        foreach ($query as $data) {
            array_push($seriesName, $data['sexe'] === 'h' ? 'Homme' : 'Femme');
            array_push($seriesData, $data['count']);
        }

        $this->piechartcomparingthesexedistributionofusers = [
            'seriesName' => $seriesName,
            'seriesData' => $seriesData,
        ];

        $this->emit('dataChanged', $this->piechartcomparingthesexedistributionofusers);
    }

    public function changechoix1($choix1)
    {
        $this->choix1 = $choix1;
        $this->updateChartData($this->choix1, $this->choix2);
        // dd($this->choix1);
        $this->emit('choix1Changed', $this->choix2);
    }

    public function changechoix2($choix2)
    {
        $this->choix2 = $choix2;
        $this->updateChartData($this->choix1, $this->choix2);
        // dd($this->choix2);
        $this->emit('choix2Changed', $this->choix2);
    }

    public function updateChartData($choix1, $choix2)
    {
        $this->histogramoftourdistributionbyinspectorandtourdurationhistogramoftotalnumberofroundsovertime($choix1, $choix2);
    }

    public function histogramoftourdistributionbyinspectorandtourdurationhistogramoftotalnumberofroundsovertime($choix1, $choix2)
    {
        // Requête pour le premier ensemble de données
        $query1 = Tournee::selectRaw('inspecteur_id, count(*) as count, AVG(TIMESTAMPDIFF(MINUTE, date, tournees.updated_at)) as avg_duration')
            ->groupBy('inspecteur_id')
            ->join('users', 'tournees.inspecteur_id', '=', 'users.id');

        // Ajouter une condition WHERE si choix1 est défini
        if ($choix1 !== null) {
            $query1->where('users.type', $choix1);
        }

        $this->barchartdistributionofthetoursperinspectorandthetourduration = $query1->get(['users.nom'])->toArray();

        // Requête pour le deuxième ensemble de données
        $query2 = Tournee::selectRaw('DATE(date) as date, count(*) as count')
            ->where('date', '>=', now()->subWeek())
            ->groupBy('date')
            ->orderBy('date');

        // Ajouter une condition WHERE si choix2 est défini
        if ($choix2 !== null) {
            // Ajouter une logique pour filtrer par rapport à choix2 (mois, semaine, etc.)
            if ($choix2 === 'mois') {
                $query2->whereMonth('date', now()->month);
            } elseif ($choix2 === 'semaine') {
                $query2->where('date', '>=', now()->startOfWeek())
                    ->where('date', '<=', now()->endOfWeek());
            }
        }

        $this->barchartrepresentingtheevolutionofthetotalnumberoftoursovertime = $query2->get()->toArray();

        // Émettre un événement avec les données chargées
        $this->emit('dataChanged', $this->barchartdistributionofthetoursperinspectorandthetourduration, $this->barchartrepresentingtheevolutionofthetotalnumberoftoursovertime);
    }


    public function newTournee($adresse_complet, $date, $etat)
{
    $validated = Validator::make(
        [
            'adresse_complet' => $adresse_complet,
            'date' => $date,
            'etat' => $etat,
        ],
        [
            'adresse_complet' => 'required|min:1|max:40',
            'date' => 'required',
            'etat' => 'required',
        ]
    )->validate();

    $tournee = Tournee::create($validated);

    return $tournee->id;
}

public function updateTournee($id, $adresse_complet, $date, $etat)
{
    $validated = Validator::make(
        [
            'date' => $date,
            'etat' => $etat,
            'adresse_complet' => $adresse_complet,
        ],
        [
            'date' => 'required',
            'etat' => 'required',
            'adresse_complet' => 'required|min:1|max:40',
        ]
    )->validate();

    Tournee::findOrFail($id)->update($validated);
}

public function render()
{
    $tournees = Tournee::all()->map(function ($tournee) {
        return [
            'id' => $tournee->id,
            'adresse_complet' => $tournee->adresse_complet,
            'date' => $tournee->date,
            'etat' => $tournee->etat,
        ];
    })->toJson();

    return view('livewire.dash-component', [
        'tournees' => $tournees
    ]);
}

}