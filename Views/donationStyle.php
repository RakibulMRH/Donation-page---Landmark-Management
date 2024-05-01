        #timeDisplay {
            transition: opacity 0.5s ease-in-out;
            opacity: 1;
        }
        #file::-webkit-progress-value 
        {
            background: purple;
            color: white;
            border-radius: 20px;
        }

        #file::-webkit-progress-bar 
        {
            background: white; 
            border: 1px solid purple; 
            border-radius: 20px;
        }
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 2px grey;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: purple;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #b319a6;
        }

        label {
            font-size: 1rem;
        }

        .error {
            font-size: 11px;
            color: red;
        }

        legend {
            color: purple;
        }

        body {
            background color: purple;
            background: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        .custom-button {
            color: purple;
            padding: 0 10px 0px 10px;
            animation: border-color-change 5s infinite;
            border-radius: 20px;
            cursor: pointer;
        }

        .custom-button:hover 
        {
            color: #b319a6; 
        }

        .donationcontent 
        {
            width: 100%;
            font-size: 18px;
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

        input[type="submit"]:hover
        {
            text-decoration-color: white;
            background: #b319a6;
            ;
        }


        input[type="button"] 
        {
            background: purple;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        .fieldset-rgb 
        {
            border: 2px solid white;
            border-radius: 7px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            animation: border-color-change 5s infinite;
        }

        .fieldset-none 
        {
            border: 1px solid white;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        @keyframes border-color-change 
        {
            0% { border-color: rgb(255, 0, 0);}

            25% { border-color: rgb(0, 255, 0);}

            50% { border-color: rgb(0, 0, 255);}

            75% { border-color: rgb(255, 255, 0);}

            100% { border-color: rgb(255, 0, 255);}
        }

         .text-animation span::before 
        {
            content: "Every Donation...";
            color: red;
            animation: animate infinite 3s;
            padding-left: 10px;
        }

        abbr { text-decoration: none;}

        abbr:hover {text-decoration: underline;}

        @keyframes animate 
        {
            0% 
            {
                content: "Every Donation...";
                color: red;
            }

            50% 
            {
                content: "makes a...";
                color: blue;
            }

            75% 
            {
                content: "Difference!";
                color: green;
            }
        }

        .green-text /*Sadaqa Jariyah*/
        {
            color: forestgreen;
            font-weight: bold;
        }

        .containerz 
        {
            background-color: white;
            width: 100%;
            padding: 2px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
        }

        .menu-table 
        {
            width: 100%;
            border-collapse: collapse;
            margin: 0; 
            padding: 0;
        }

        .menu-row, .menu-column 
        {
            background-color: purple;
            border: 0;
            border-color: transparent;
            margin: 0; 
            padding: 0;
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
            transform: translate(-50%, -50%); /* Center the container */
            transition: box-shadow 0.5s ease-in-out;
            box-shadow: 0 0 20px purple;
        }

        .logo-container:hover { box-shadow: 0 0 20px white; }

        .round-logo {
            width: 124px; 
            height: 87px;
            border-radius: 0%; 
            position: absolute;
            top: 49%;
            left: 50%;
            transform: translate(-50%, -50%); /* Center the image within the container */
            z-index: 2;
        }