@component('mail::message')
# ICCT COLLEGES INC.


Thank you for creating a questionaire.

Department: {{ $courses->dept_name }} <br/>
Course: {{ $courses->course_name }}<br/>
Shool year: {{$courses->sy_start}} - {{$courses->sy_end}}


<h4>- Questionaire -</h4><br/>
<ul>
  <li><p><b>Multiple Choice:</b> {{$courses->questions->count()}} items</p></li>
  <li><p><b>True or false:</b> {{$courses->trueorfalse->count()}} items</p></li>
  <li><p><b>Matching type:</b> {{$courses->matchingtype->count()}} items</p></li>
</ul>

@component('mail::button', ['url' => url('/department')])
View
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
