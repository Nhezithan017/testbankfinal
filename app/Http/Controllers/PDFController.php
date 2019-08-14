<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Course;

class PDFController extends Controller
{
    
    public function downloadPDF($courseId){
    
        $courses = Course::findOrFail($courseId);
        
                foreach(range('a','z') as $i) {
                    echo $char[] = $i; 
                   }

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('backend.download',[
            'courses' => $courses,
            'char' => $char,
            ]);
            
       return $pdf->stream('invoice.pdf');
       
        

    }

}
