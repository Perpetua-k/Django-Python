<div class="container-fluid">
    <form action="" id="book-form">
        <div class="form-group">
            <input name="package_id" type="hidden" value="<?php echo $_GET['package_id'] ?>" >
            <input type="date" class='form form-control' required name='schedule'>
        </div>
        <button type="submit" class="btn btn-primary">Book Now</button>
    </form>
</div>
<script>
    $(function(){
        $('#book-form').submit(function(e){
            e.preventDefault();
            
            var selectedDate = new Date($(this).find('input[name="schedule"]').val() + 'T00:00:00'); // Convert selected date to a JavaScript Date object
            var currentDate = new Date(); // Get the current date

            // Check if the selected date is in the past
            if (selectedDate < currentDate) {
                alert_toast("Please select a future date for booking.", 'error');
                return;
            }

            start_loader();
            
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=book_tour",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                error: err => {
                    console.log(err);
                    alert_toast("An error occurred", 'error');
                    end_loader();
                },
                success: function (resp) {
                    if (typeof resp == 'object' && resp.status == 'success') {
                        alert_toast("Book Request Successfully sent.");
                        $('.modal').modal('hide');
                    } else {
                        console.log(resp);
                        alert_toast("An error occurred", 'error');
                    }
                    end_loader();
                }
            });
        });
    });
</script>