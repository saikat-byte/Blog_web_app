<body style="background-color:grey">
    <table align="center" border="0" cellpadding="0" cellspacing="0"
           width="550" bgcolor="white" style="border:2px solid black">
        <tbody>
            <tr>
                <td align="center">
                    <table align="center" border="0" cellpadding="0"
                           cellspacing="0" class="col-550" width="550">
                        <tbody>
                            <tr>
                                <td align="center" style="background-color: #4cb96b;
                                           height: 50px; padding-left: 20px;">

                                    <a href="{{ route('frontend.index') }}" style="text-decoration: none;">
                                        <p style="color:white;
                                                  font-weight:bold;">
                                            {{ config('app.name') }}
                                        </p>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr style="height: 50px;">
                <td align="center" style="border: none;
                           border-bottom: 2px solid #4cb96b;
                           padding-right: 20px;padding-left:20px">

                    <p>
                       Name: {{ $contact['name'] }}
                    </p>
                    <p>
                       Email: {{ $contact['email'] }}
                    </p>
                    <p>
                       Phone: {{ $contact['phone'] }}
                    </p>
                </td>
            </tr>

            <tr style="display: inline-block;">
                <td style="height: 150px;
                           padding: 20px;
                           border: none;
                           border-bottom: 2px solid #361B0E;
                           background-color: white;">

                    <h2 style="text-align: left;
                               align-items: center;">
                        Subject : {{ $contact['subject'] }}
                   </h2>
                    <p class="data"
                       style="text-align: justify-all;
                              align-items: center;
                              font-size: 15px;
                              padding-bottom: 12px;">
                        Message : {{ $contact['message'] }}
                    </p>
                    <p>
                        <a href=""
                           style="text-decoration: none;
                                  color:black;
                                  border: 2px solid #4cb96b;
                                  padding: 10px 30px;
                                  font-weight: bold;">
                           Read More
                      </a>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</body>


