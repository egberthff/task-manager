   
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

   <script>
      document.addEventListener('DOMContentLoaded', function() {
         // Define the base URL using PHP, but outside the `complete()` function
         const baseUrl = "<?= base_url('/task/complete/') ?>";

         function isCompleted() {

            alert(id);
            return false;
            const taskId = id.split('_');

            if (taskId.length > 1) {
               $.ajax({
                  type: 'post',
                  url: baseUrl + taskId[1], // Use the correct array index
                  success: function(response) {
                     try {
                        const data = JSON.parse(response);
                        if (data.success) {
                           alert(data.success);
                           location.reload(); // Reload the page on success
                        }
                     } catch (e) {
                        console.error('Error parsing JSON response:', e);
                     }
                  },
                  error: function(xhr, status, error) {
                     console.error("AJAX Error:", status, error);
                     alert("An error occurred during the request.");
                  }
               });
            } else {
               console.error("Invalid ID format for complete() function.");
            }
         }

         function complete(){
            alert('this is fn');
         }

         // document.querySelectorAll('[id^="complete_"]').forEach(button => {
         //    button.addEventListener('click', function() {
         //       complete(this.id);
         //    });
         // });

      });
   </script>
   </body>

   </html>