<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Payment Page</title>
        <script> 
            function confirmBooking (){
                //Retrieve payment information
                const cardnumber = document.getElementById('cardNumber').value;
                const expiryDate = document.getElementById('expiryDate').value;

                //Validate form fields
                if (!cardNumber || !expiryDate) {
                    alert('Please fill in all payment details to confirm the booking.');
                    return;
                }

                //Simulate confirming the booking (you would typically send data to the server here)
                 ('Booking Confirmed!');
                success:function(resp){
                    if(typeof resp == 'object' && resp.status == 'success'){
                        alert_toast("Book Request Successfully sent.")
                        $('.modal').modal('hide')
                    }else{
                        console.log(resp)
                        alert_toast("an error occured",'error')
                    }
                    end_loader()
                }
            }
        </script>
    </head>
    <body>
        <h1>Payment Page</h1>
        <!--Payment form-->
        <form id="paymentForm">
            <label for="cardNumber">Card Number:</label>
            <input type="text" id="cardNumber" required>
            <br>
            <label for="expiryDate">Expiry Date:</label>
            <input type="text" id="expiryDate" required>
            <br>
            <button type="button" onclick="confirmBooking()">Confirm Booking</button>
        </form>
    </body>
</html>