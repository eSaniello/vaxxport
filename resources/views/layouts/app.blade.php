<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
    </script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.0/dist/chart.min.js"></script>

    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>VAXXPORT</title>

    <style>
        input[type=checkbox]:disabled:checked {
            outline: 1.5px solid rgb(0, 190, 0);
        }

        /* Tab content - closed */
        .tab-content {
            max-height: 0;
            -webkit-transition: max-height .35s;
            -o-transition: max-height .35s;
            transition: max-height .35s;
        }

        /* :checked - resize to full height */
        .tab input:checked~.tab-content {
            max-height: 100vh;
        }

        /* Label formatting when open */
        .tab input:checked+label {
            /*@apply text-xl p-5 border-l-2 border-indigo-500 bg-gray-100 text-indigo*/
            font-size: 1.25rem;
            /*.text-xl*/
            padding: 1.25rem;
            /*.p-5*/
            border-left-width: 2px;
            /*.border-l-2*/
            border-color: #6574cd;
            /*.border-indigo*/
            background-color: #f8fafc;
            /*.bg-gray-100 */
            color: #6574cd;
            /*.text-indigo*/
        }

        /* Icon */
        .tab label::after {
            float: right;
            right: 0;
            top: 0;
            display: block;
            width: 1.5em;
            height: 1.5em;
            line-height: 1.5;
            font-size: 1.25rem;
            text-align: center;
            -webkit-transition: all .35s;
            -o-transition: all .35s;
            transition: all .35s;
        }

        /* Icon formatting - closed */
        .tab input[type=checkbox]+label::after {
            content: "+";
            font-weight: bold;
            /*.font-bold*/
            border-width: 1px;
            /*.border*/
            border-radius: 9999px;
            /*.rounded-full */
            border-color: #b8c2cc;
            /*.border-grey*/
        }

        .tab input[type=radio]+label::after {
            content: "\25BE";
            font-weight: bold;
            /*.font-bold*/
            border-width: 1px;
            /*.border*/
            border-radius: 9999px;
            /*.rounded-full */
            border-color: #b8c2cc;
            /*.border-grey*/
        }

        /* Icon formatting - open */
        .tab input[type=checkbox]:checked+label::after {
            transform: rotate(315deg);
            background-color: #6574cd;
            /*.bg-indigo*/
            color: #f8fafc;
            /*.text-grey-lightest*/
        }

        .tab input[type=radio]:checked+label::after {
            transform: rotateX(180deg);
            background-color: #6574cd;
            /*.bg-indigo*/
            color: #f8fafc;
            /*.text-grey-lightest*/
        }
    </style>
</head>

<body class="">
    @yield('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
</body>

</html>