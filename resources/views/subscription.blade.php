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
  <h1>Subscription</h1>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="links">
                <form action="/subscribe" method="POST">
                    @csrf
                    <button type="submit" class>PayPal Subscribe</button>
                </form>
                <a href="/subscription" class="mb-3">Go to subscription</a>
                <div id="paypal-button"></div>
            </div>
        </div>
    </div>

    <!-- <script src="https://www.paypalobjects.com/api/checkout.js"></script> -->
    <script
       src="https://www.paypal.com/sdk/js?client-id=AegwPJu2vucXLvUO_gLL9sIqYeNBF6E6QzKUCkOfT08PpDL1mIHLsEJc9GWWoLfMLLPDq8e1-dvyDRc0&vault=true">
    </script>
    <script>
        paypal.Buttons({
            createSubscription: function(data, actions) {

                return actions.subscription.create({
                    'plan_id': 'P-4HC088875C116804UL3VBJKQ'
                });
            },

            onApprove: function(data, actions) {
                console.log('DATA555', data)
                console.log('ACT555', actions)
                alert('You have successfully created subscription ' + data.subscriptionID);
            }
        }).render('#paypal-button');

    </script>
  </body>
</html>
