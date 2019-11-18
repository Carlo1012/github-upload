// this is for notification
  $(document).ready(function(){

    function load_unseen_notification(view = ''){
    $.ajax({
     url:"fetch.php",
     method:"POST",
     data:{view:view},
     dataType:"json",
     success:function(data) {
      $('.notif').html(data.notification); //notif is var declared by me in navigation.html
      if(data.unseen_notification > 0) {
       $('.count').html(data.unseen_notification);
      }
     }
    });
    }
    
    load_unseen_notification();

    // comment muna para di mawala notifications
    $(document).on('click', '.dropdown-toggle', function(){
     $('.count').html('');
     load_unseen_notification('yes');
    });

    setInterval(function(){ 
     load_unseen_notification();; 
    }, 5000);

  });