<?php

namespace App\Http\Controllers;

use App\Models\Rapport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use ZipArchive;

class DashboardController extends Controller {

    function index() {

        // $tournees = auth()->user()->tournees;
        // dd($tournees);

        // $tournees = Tournee::where('date', '>', now()->subDays(7))->where('date', '<', now()->addDay())->get()->groupBy(function($p){
        //     return Carbon::parse($p->date)->format('d/m/y');
        // });

        // $tournees_stats = [];
        // $tournees_stats['libelle'] = [];
        // $tournees_stats['data']= [];
        // foreach ($tournees as $key => $tournee_liste) {
        //     array_push($tournees_stats['libelle'], $key);

        //     $index = 0;
        //     $tournees_stats['data'][$index] = [];
        //     foreach ($tournee_liste as $tournee) {
        //         array_push($tournees_stats['data'][$index], $tournee);
        //     }
        //     $index ++;
        // }

        // dd($tournees_stats, $tournees);
        return view('dashboard');
        }


    function generer_rapport(Rapport $rapport) {
        $tournee = $rapport->tournee;

        $pdf = PDF::loadView('rapports.doc', compact('rapport', 'tournee'));
        return $pdf->stream();
    }

    function generer_rapport_ademe(Request $request) {
        try {
            if ($request->ids == null) {
                return redirect()->back()->with('error', 'Vous devez sélectionner au moins un rapport');
            } else if (count($request->ids) > 20) {
                return redirect()->back()->with('error', 'Vous devez sélectionner 20 rapports au plus');
            }

            $files = $this->generate_pdf_files($request->ids);
            $zip = $this->generate_zip($files);
            $this->delete_pdf_files($files);
            return response()->download(public_path($zip))->deleteFileAfterSend();
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('danger', 'Une erreur est survenue lors de la génération du rapport');
        }
    }

    function generate_pdf_files($ids) {

        $files = [];
        foreach ($ids as $id) {
            $rapport = Rapport::find($id);
            $tournee = $rapport->tournee;

            $file_name = public_path("/rapports_pdf/" . str_replace(' ', '_', $tournee->date) . '_' . count($files) + 1 . '.pdf');
            PDF::loadView('rapports.doc', compact('rapport', 'tournee'))->save($file_name);
            array_push($files, $file_name);
        }

        return $files;
    }

    function delete_pdf_files($files) {
        foreach ($files as $file) {
            File::delete($file);
        }

        return $files;
    }

    function generate_zip($files) {
        $zip = new ZipArchive();

        $zipFileName = "/rapport_" . str_replace(' ', '_', now()) . '.zip';
        if ($zip->open(public_path($zipFileName), ZipArchive::CREATE) === TRUE) {

            foreach ($files as $pdfFile) {
                if (file_exists($pdfFile)) {
                    $zip->addFile($pdfFile, explode('public/', $pdfFile)[1]);
                }
            }

            // Fermer le zip
            $zip->close();

            // Retourner le nom du fichier zip créé
            return $zipFileName;
        }

        return false;
    }


}