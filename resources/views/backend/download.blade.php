
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    *{
        margin: 5px;
    }
    h2{
        text-align: center;
    }

    .col-left-header{
        float: left;
        text-align: left;
    }
    .col-left-header{
        float: right;
        text-align: left;
    }
    p{
        line-height: 1;
        font-size: 12pt;
        text-align:justify;

    }
    #p-question{
        word-wrap:break-word;
    }
    hr{
        border:0.1px solid black;
    }
    #directions{
        text-align: justify;
    }
    div{
        /* border:1px solid red; */
        margin:0;
        padding:0;
    }
    .col-left-answer{
        float:left;
       text-align: left;
       margin-left:50px;
      
    }
    .col-right-answer{
        float:left;
    margin-left:150px;
 
    }
    .page-break {
        page-break-after: always;
    }
    .h-instruction{
        margin: 30px 0 20px 0;
    }
    #tof{
        margin-left: 50px;
    }
</style>
<body>
    <div>
        <h2>QUESTION PAPER</h2>
    </div>
    <div id="header">
        <div class="col-left-header">
            <p>{{ $courses->dept_name}} ({{ $courses->period}})</p>
            <p>{{ $courses->trimester}} A.Y {{ $courses->sy_start }} - {{ $courses->sy_end}}</p>
          
        </div>
            <div class="col-right-header">
                <p>{{ $courses->course_code}}</p>
                <p>({{ $courses->course_name}})</p>
            </div>
     </div>
     <hr>
     <div id="directions">
            <p >
                <b>General Directions:</b>   Do not write anything on the Question Paper. Use the official ICCT Colleges Exam Answer Booklet.
                Write your Examinee Information in the boxes of the cover page of your Exam Answer Booklet. Please write clearly, completely
                and in capital letter. Read each question carefully. Make sure that you know what you have to do before starting your answer.Avoid 
                unneccessary erasures. Use black ballpen only.
            </p>
   </div>
      <hr>
      @if($courses->questions->count() > 0)
      <div class="h-instruction">
          <p><b>MULTIPLE CHOICE</b></p>
          <p>Instruction(s): Write the letter of the correct answer.</p>
      </div>       
      @foreach($courses->questions as $key => $value)
             <div><p id="p-question">{{$key + 1}}.{{$value['question']}}</p></div>
            <div id="answer">
                <div class="col-left-answer">
                <p>A. {{ $value['A']}}</p>
                <p>B. {{  $value['B']}}</p>
            </div>
                <div>
                    <p>C. {{ $value['C']}}</p>
                    <p>D. {{  $value['D']}}</p>
                </div>
        </div>
       @endforeach 
    
    @endif
    @if($courses->trueorfalse->count() > 0)
    <div  class="h-instruction">
            <p><b>TRUE OR FALSE</b></p>
            <p>Instruction(s): Write T if the statement is true else F.</p>
        </div>
      
        <div id="tof">
      @foreach($courses->trueorfalse as $key => $value)
        <p>{{$key + 1}}. {{$value['ques_name']}} </p>
        @endforeach 
        </div>
    
    @endif
    @if($courses->matchingtype->count() > 0)
    <div  class="h-instruction">
        <p><b>MATCHING TYPE</b></p>
        <p>Instruction(s): Write the letter of the correct answer.</p>
    </div>
    <div>
        <div class="col-left-answer">
            <h4>COLUMN A</h4>
            <br/>
            @foreach($courses->matchingtype as $key => $value)
        <p> {{$key + 1}}. {{$value['premises']}}</p>
         @endforeach
        </div>
        <div class="col-right-answer">
            <h4>COLUMN B</h4>
            <br/>
            @foreach($courses->matchingtype->shuffle() as $key => $value)
           <p> {{$x= $char[$key]}}. {{$value['responses']}}</p>
         @endforeach
       
        </div>
        
    </div>
    <div class="page-break"></div>
    <div>
        <h2>ANSWER SHEET</h2>
    </div>
    <div id="header">
            <div class="col-left-header">
                <p>{{ $courses->dept_name}} ({{ $courses->period}})</p>
                <p>{{ $courses->trimester}} A.Y {{ $courses->sy_start }} - {{ $courses->sy_end}}</p>
              
            </div>
                <div class="col-right-header">
                    <p>{{ $courses->course_code}}</p>
                    <p>({{ $courses->course_name}})</p>
                </div>
         </div>
         <hr>
         @if($courses->questions->count() > 0)
         <div class="h-instruction">
             <p><b>MULTIPLE CHOICE</b></p>
         </div>       
         @foreach($courses->questions as $key => $value)
              <div>
              <p>{{ $key + 1}}. {{$value['answer']}}</p>
              </div>
          @endforeach 
       
       @endif
       @if($courses->trueorfalse->count() > 0)
         <div class="h-instruction">
             <p><b>TRUE OR FALSE</b></p>
         </div>       
         @foreach($courses->trueorfalse as $key => $value)
              <div>
              <p>{{ $key + 1}}. {{$value['isCorrect'] == 1 ?'T' : 'F'}}</p>
              </div>
          @endforeach 
       
       @endif
       @if($courses->trueorfalse->count() > 0)
       <div class="h-instruction">
           <p><b>MATCHING TYPE</b></p>
       </div>       
       @foreach($courses->matchingtype as $key => $value)
            <div>
            <p>{{ $key + 1}}. {{$value['responses']}}</p>
            </div>
        @endforeach 
     
     @endif
    @endif
    <script type="text/php">

        if (isset($pdf)) {
            $pdf->page_script('
              $font = $fontMetrics->get_font(\'DejaVu Sans, Arial,
      Helvetica, sans-serif\', \'normal\');
              {{-- $pageText = $PAGE_NUM . \' / \' . $PAGE_COUNT; --}}
              $pageText = "ICCT COLLEGES INC.";
              $y = 770;
              $x = 10;
              $size = 7;
              $pdf->text($x, $y, $pageText, $font, $size);
            ');
        }
      
      </script>
</body>
</html>