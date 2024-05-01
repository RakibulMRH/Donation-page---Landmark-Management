<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' href='style.css'>
    <script src='main.js'></script>
    <style>
        .menu-table 
        {
            width: 100%;
            border: 0;
            border-collapse: collapse;
        }

        .menu-row 
        {
            background-color: purple;
        }

        .menu-button 
        {
            text-decoration: none;
            color: white;
            padding: 9px 20px;
            background: purple;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            display: inline-block;
            text-align: center;
        }

        .menu-button: 
        {
            background: #b319a6;
            padding: auto;
        }

        label 
        {
            font-size: 1rem;
        }

        .error 
        {
            font-size: 11px;
            color: red;
        }

        legend 
        {
            color: purple;
        }

        body 
        {
            background color: purple;
            background: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        .custom-button 
        {
            color: purple;
            padding: 0 10px 0px 10px;
            animation: border-color-change 5s infinite;
            border-radius: 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover 
        {
            text-decoration-color: white;
            background: #b319a6;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        textarea 
        {
            width: 60%;
            padding: 10px;
            margin-top: 5px;
        }


        input[type="submit"] 
        {
            background: purple;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        input[type="button"] 
        {
            background: purple;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        fieldset 
        {
            border: 1.8px solid white;
            border-radius: 7px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            animation: border-color-change 5s infinite;
            background-color: white;
        }


        @keyframes border-color-change 
        {
            0% { border-color: rgb(255, 0, 0);}

            25% { border-color: rgb(0, 255, 0);}

            50% { border-color: rgb(0, 0, 255);}

            75% { border-color: rgb(255, 255, 0);}

            100% { border-color: rgb(255, 0, 255);}
        }

        .green-text {
            color: forestgreen;
            font-weight: bold;
        }

        .hidden-checkbox {
            display: none;
        }

        .approved-checkbox {
            display: none;
        }

        .pending-checkbox {
            display: none;
        }

        .color-button {
            width: 15px;
            height: 20px;
            cursor: pointer;
            border: 1px solid #ccc;
            background-color: lightgray;
            display: block;
            position: relative;
        }

        .color-button:hover 
        {
            background-color: dimgray;
        }

        .colorappv-button 
        {
            width: 15px;
            height: 20px;
            cursor: pointer;
            border: 1px solid #ccc;
            background-color: lightgray;
            display: block;
            position: relative;
        }

        .colorpending-button 
        {
            width: 15px;
            height: 20px;
            cursor: pointer;
            border: 1px solid #ccc;
            background-color: lightgray;
            display: block;
            position: relative;
        }

        .red-text 
        {
            color: red;
            font-weight: bold;
        }

        .purple-text 
        {
            color: purple;
            font-weight: bold;
        }

        

        .hidden-checkbox:disabled + .color-button {
            background-color: indianred;
        }

        .approved-checkbox:checked + .colorappv-button {
            background-color: green;
        }

        .approved-checkbox:disabled + .colorappv-button {
            background-color: green;
        }

        .pending-checkbox:checked + .colorpending-button {
            background-color: gold;
        }

        .pending-checkbox:disabled + .colorpending-button {
            background-color: gold;
        }

        table 
        {
            border-collapse: collapse;
            margin: 0 auto;
        }

        td {
            padding: 3px;
        }

        .color-box 
        {
            display: inline-block;
            width: 15px;
            height: 20px;
            margin-right: 10px;
        }

        .lightgray { background-color: lightgray;}

        .yellow { background-color: gold;}

        .cyan { background-color: darkcyan;}

        .darkgreen { background-color: green;}

        .purple { background-color: purple;}

        .indianred { background-color: indianred;}

        .red { background-color: red;}

        .color-container 
        {
            text-align: center;
            margin: 20px;
        }

        .menu-table 
        {
            width: 100%;
            border: 0;
            border-collapse: collapse;
            row
        }

        .menu-row 
        {
            background-color: purple;
            border-collapse: collapse;
        }

        .menu-button 
        {
            text-decoration: none;
            color: white;
            padding: 9px 20px;
            background: purple;
            border: none;
            border-radius: 0px;
            cursor: pointer;
            transition: background 0.3s;
            display: inline-block;
            text-align: center;
        }

        .menu-button:hover 
        {
            background: #b319a6;
            padding: auto;
        }

        .logo-container 
        {
            width: 126px; 
            height: 89px;
            border-radius: 0%; 
            background-color: purple;
            position: absolute;
            top: 48%;
            left: 50%;
            transform: translate(-50%, -50%); 
            transition: box-shadow 0.5s ease-in-out;
            box-shadow: 0 0 20px purple;
        }

        .logo-container:hover { box-shadow: 0 0 20px white;}

        .round-logo 
        {
            width: 124px; 
            height: 87px;
            border-radius: 0%; 
            position: absolute;
            top: 49%;
            left: 50%;
            transform: translate(-50%, -50%); 
            z-index: 2;
        }

        input[type="date"] 
        {
            width: auto;
            padding: 10px;
            margin-top: 5px;
        }

        ::-webkit-scrollbar 
        {
            width: 10px;
        }

        ::-webkit-scrollbar-track 
        {
            box-shadow: inset 0 0 2px grey;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb 
        {
            background: purple;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover 
        {
            background: #b319a6;
        }

    </style>
</head>
<body>
    
</body>
</html>