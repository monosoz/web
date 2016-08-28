
<div class="usrp-fb-1" onclick="_urq.push(['Feedback_Open']);">
    <i>
        <svg viewBox="0 0 50 50" enable-background="0 0 50 50">
          <path class="fill" d="M25.5,13c-4.7,0-8.5,3.8-8.5,8.5c0,4.7,3.8,8.5,8.5,8.5c4.7,0,8.5-3.8,8.5-8.5C34,16.8,30.2,13,25.5,13z M26,29v-3.3l0.6,0.6c0.1,0.1,0.2,0.1,0.4,0.1s0.3,0,0.4-0.1l1.5-1.5c0.2-0.2,0.2-0.5,0-0.7s-0.5-0.2-0.7,0L27,25.3l-1.1-1.1c0,0-0.1-0.1-0.2-0.1c-0.1-0.1-0.3-0.1-0.4,0c-0.1,0-0.1,0.1-0.2,0.1L24,25.3l-0.9-0.9c-0.2-0.2-0.5-0.2-0.7,0s-0.2,0.5,0,0.7l1.2,1.2c0.2,0.2,0.5,0.2,0.7,0l0.6-0.6V29c-3.9-0.3-7-3.5-7-7.5c0-4.1,3.4-7.5,7.5-7.5s7.5,3.4,7.5,7.5C33,25.5,29.9,28.7,26,29z"/>
          <path class="fill" d="M28,31h-5c-0.3,0-0.5,0.2-0.5,0.5S22.7,32,23,32h5c0.3,0,0.5-0.2,0.5-0.5S28.3,31,28,31z"/>
          <path class="fill" d="M28,33h-5c-0.3,0-0.5,0.2-0.5,0.5S22.7,34,23,34h5c0.3,0,0.5-0.2,0.5-0.5S28.3,33,28,33z"/>
          <path class="fill" d="M28,35h-5c-0.3,0-0.5,0.2-0.5,0.5S22.7,36,23,36h2v0.5c0,0.3,0.2,0.5,0.5,0.5s0.5-0.2,0.5-0.5V36h2c0.3,0,0.5-0.2,0.5-0.5S28.3,35,28,35z"/>
        </svg>            
    </i>
    <div class="usrp-fb-title">Feedback</div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
        
        /* Slide the feedback button in and out - we suggest doing this once per session only */
    
        setTimeout(function(){
            $('.usrp-fb-1').addClass('slide-in');
        }, 1000);       
        
        setTimeout(function(){
            $('.usrp-fb-1').removeClass('slide-in');
        }, 2000);       

  });
</script>
@section('stylesheet')

  <link href="{{ url('st04.css') }}" rel="stylesheet">
@endsection