<!DOCTYPE html>
<html>
<head>
    <title>Card</title>
    <meta name="viewport" content="initial-scale=1">
</head>
<body>
    <style>
        .demo-container {
            width: 100%;
            max-width: 350px;
            margin: 50px auto;
        }

        form {
            margin: 30px;
        }
        input {
            width: 200px;
            margin: 10px auto;
            display: block;
        }

    </style>
    <div class="demo-container">
        <div class="card-wrapper"></div>

        <div class="form-container active">
            <form action="/rest">
                <input placeholder="Card number" type="text" id="card-number" name="card-number">
                <input placeholder="Full name" type="text" id="full-name" name="full-name">
                <input placeholder="MM" type="text" id="expiry-month" name="expiry-month">
                <input placeholder="YY" type="text" id="expiry-year" name="expiry-year">
                <input placeholder="CVC" type="text" name="cvv" id="cvv">
                <button type="submit" class="btn btn-success">Pay Now</button>
            </form>
        </div>
    </div>
    <script src="js/jquery.card.js"></script
    <script src="js/card.js"></script>
    <script>
        new Card({
            form: document.querySelector('form'),
            container: '.card-wrapper'
        });
    </script>
</body>
</html>
