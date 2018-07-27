<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B"
        crossorigin="anonymous">
    <style>
        .back-to-top {
            cursor: pointer;
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
            border-radius: 50%
        }

        .centered {
            width: 100%;
            position: relative;
            padding: 0 10.5vw;
            margin: 0 auto;
            padding-top: 10em
        }

        body {
            color: black;
            background-color: #ededed
        }

        .h-listing img {
            width: 100%;
            height: 100%;
        }

        .forty-box p {
            font-size: 21px;
            line-height: 26px;
            margin-bottom: 26px;
            max-height: 240px;
            overflow: hidden
        }

        a {
            color: black;
        }

        a:hover {
            color: black;
            text-decoration: none
        }

        .forty-box {
            width: 40%;
            height: 100%;
            padding: 43px 49px;
            position: absolute;
            top: 0;
            right: 0;
            background: #fff;
        }

        .sixty-box {
            width: 60%;
            float: left;
            overflow: hidden;
        }

        .headline {
            font-size: 55px;
            line-height: 52px;
            padding-bottom: 28px;
        }

        .place-row {
            height: 368px;
            overflow: hidden;
            transition: 0.4s all ease
        }

        .place-row:hover {
            box-shadow: 0px 3px 10px 0px rgba(0, 0, 0, 0.15)
        }

        .place-row .row {
            height: 100%
        }

        .fa-spinner {
            font-size: 4em;
            color: blue;
        }

        @media(max-width:768px) {
            .forty-box,
            .sixty-box {
                width: 100%
            }
            .place-row {
                height: auto
            }

            .forty-box {
                height: 375px;
                position: static
            }
        }

    </style>

</head>

<body>


    <div class='centered grey listing-container'>

        <div class="row">
            @foreach ($hotels as $hotel)
            <div class="col-md-12 h-listing mb-5 place-row">
                <div class="row">
                    <div class="p-0  sixty-box">
                        <a href="/detail">
                            <img src="{{asset('img/'.$hotel->image)}}" class='img img-responsive' alt="">
                        </a>
                    </div>
                    <div class=" forty-box">
                        <a href="/detail">
                            <h4 class='headline'>{{$hotel->name}}</h4>
                            <p>{{$hotel->description}}</p>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="col-md-12 h-listing mb-5 place-row listing-clone d-none">
            <div class="row">
                <div class="p-0  sixty-box">
                    <a href="/detail">
                        <img src="{{asset('img/')}}" class='img img-responsive' alt="">
                    </a>
                </div>
                <div class=" forty-box">
                    <a href="/detail">
                        <h4 class='headline'>{{$hotel->name}}</h4>
                        <p>{{$hotel->description}}</p>
                    </a>
                </div>
            </div>
        </div>

        <div class='d-flex p-5 text-center justify-content-center'>
            <i class='fa fa-spin fa-spinner d-none' aria-hidden="true"></i>
        </div>

    </div>



    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page"
        data-toggle="tooltip" data-placement="left">
        <i class="fas fa-arrow-up"></i>
    </a>






    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em"
        crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {

                    var isfetching = false;

                    var listing_limit = 9;
                    window.onscroll = function (e) {
                        var _windowHeight = window.innerHeight || document.documentElement.clientHeight || document
                            .body.clientHeight,
                            _scrollPos = window.scrollY || window.pageYOffset || document.documentElement.scrollTop;

                        if ((_windowHeight + _scrollPos) >= document.body.offsetHeight) {
                            if (isfetching == false) {
                                requestListings()
                            }
                        }
                    };

//                    $(window).scroll(function () {
                        //    if ($(window).scrollTop() == $(document).height() - $(window).height()) {
                        //    if(isfetching == false){
                        //          requestListings()
                        //        }      
                        //  }
                        //    });

                        //    window.onscroll = function(ev) {
                        //      if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight - 700) {
                        //     }
                        //  };


                        $(window).scroll(function () {
                            if ($(this).scrollTop() > 50) {
                                $('#back-to-top').fadeIn();
                            } else {
                                $('#back-to-top').fadeOut();
                            }
                        });
                        // scroll body to 0px on click
                        $('#back-to-top').click(function () {
                            $('body,html').animate({
                                scrollTop: 0
                            }, 800);
                            return false;
                        });


                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });


                        function requestListings() {
                            isfetching = true;
                            url = '/fetch';
                            var fd = new FormData(this);
                            fd.append('limit', listing_limit)

                            $('.fa-spinner').removeClass('d-none')
                            request = $.ajax({
                                method: "post",
                                url: url,
                                data: fd,
                                cache: false,
                                processData: false,
                                contentType: false,
                            });


                            request.done(function (response) {
                                $('.fa-spinner').addClass('d-none')
                                if (response) {
                                    for (let index = 0; index < response.length; index++) {
                                        let newlisting = $('.listing-clone').clone();
                                        $(newlisting).removeClass('d-none')
                                        $(newlisting).removeClass('listing-clone')
                                        let image_link = $(newlisting).find('img').attr('src')
                                        image_link = image_link + '/' + response[index].image
                                        $(newlisting).find('img').attr('src', image_link)
                                        $(newlisting).find('h4').text(response[index].name)
                                        $(newlisting).find('p').text(response[index].description)
                                        $(newlisting).appendTo('.listing-container > .row')
                                    }
                                }
                                listing_limit += 9
                                isfetching = false;
                            });
                        }
                    });

    </script>


</body>

</html>
