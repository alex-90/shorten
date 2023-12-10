<div class="container col-xl-10 col-xxl-8 px-4 py-5">
   <div class="row align-items-center g-lg-5 py-5">
   <div class="col-lg-7 text-center text-lg-start">
      <h1 class="display-4 fw-bold lh-1 mb-3">Paste URL and get short link</h1>
      <p class="col-lg-10 fs-4">Recently added</p>
      <div>
         <ul id="last-items">
            @foreach($last as $item)
            <li>
               <a href="{{ Request::url() . '/' . $item->alias }}" target="_blank">{{ Request::url() . '/' . $item->alias }}</a>
            </li>
            @endforeach
         </ul>
      </div>
   </div>
   <div class="col-md-10 mx-auto col-lg-5">
      <form class="p-4 p-md-5 border rounded-3 bg-light">
         <div class="form-floating mb-3">
            <input type="text" class="form-control" id="link">
            <label for="link">Paste URL here</label>
         </div>

         <button class="w-100 btn btn-lg btn-primary" type="submit" id="send">Shorten.it!</button>
      </form>
   </div>
   </div>
</div>
<script>
   $(document).ready(function(){
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
         }
      });
      $('#send').on('click', function(e){
         e.preventDefault();

         const url = $('#link').val();

         if (!url) {
            alert('Empty URL field!')
         } else {
            $.ajax({
               url: 'send',
               method: 'POST',
               data: {url},
               dataType: 'JSON',
               success: function(res) {
                  const { id, alias } = res;

                  $.ajax({
                     success: function(html) {
                        $('#last-items').html(
                           $(html).find('#last-items').html()
                        );
                     }
                  })

                  $('#link').val('');
               },
               error: function (xhr, ajaxOptions, thrownError) {
                  const jsonResponse = JSON.parse(xhr.responseText);

                  alert(jsonResponse.message);
               }
            })
         }
      })
   })
</script>