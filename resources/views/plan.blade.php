<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Subscription</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

<!-- Styles -->
<style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }

    #paypal-button {
      padding-top: 12px;
    }
</style>
</head>
<body>
  <h1>Plan</h1>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="links">
                <a href="/subscription" class="mb-3">Go to subscription</a>
                <div id="paypal-button"></div>
            </div>
        </div>
    </div>

    <script src="https://www.paypal.com/sdk/js?client-id={{ getenv("CLIENT_ID") }}"></script>
    <!-- <script src="https://www.paypalobjects.com/api/checkout.js"></script> -->
    <!-- <script src="https://www.paypalobjects.com/api/checkout.js"></script> -->
    <script>
    /*paypal.Button.render({
        env: 'sandbox', // Or 'production'
        style: {
        size: 'large',
        color: 'gold',
        shape: 'pill',
        },
        // Set up the payment:
        // 1. Add a payment callback
        payment: function(data, actions) {
        // 2. Make a request to your server
        return actions.request.post('/api/plan/create-payment')
            .then(function(res) {
            // 3. Return res.id from the response
            console.log(res.result.id);
            return res.result.id;
            //return res.id;
            });
        },
        // Execute the payment:
        // 1. Add an onAuthorize callback
        onAuthorize: function(data, actions) {
            console.log('DATA', data)
            console.log('Actions', actions)
        // 2. Make a request to your server
        return actions.request.post('/api/plan/execute-payment', {
            paymentID: data.paymentID,
            payerID:   data.payerID,
            orderID:   data.orderID,
        })
            .then(function(res) {
            console.log(res);
            alert('PAYMENT WENT THROUGH!!');
            // 3. Show the buyer a confirmation message.
            });
        }
    }, '#paypal-button');*/
    paypal.Buttons().render('#paypal-button');
    </script>
  </body>
</html>
