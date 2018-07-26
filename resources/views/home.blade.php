<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <style>
    .back-to-top {
    cursor: pointer;
    position: fixed;
    bottom: 20px;
    right: 20px;
    display:none;
    border-radius:50%
    }
    body{
        color:black
    }
    .h-listing .row{
        border-radius:5px;
        border:1px solid darkgray;
        overflow:hidden;
        height:198px
    }

    .h-listing img{
        width:100%;
        height:196px
    }

    .h-listing p{
        max-height:143px;
        overflow:hidden
    }

    a{
        color:black;        
    }

    a:hover{
        color:black;
        text-decoration:none
    }
    </style>

  </head>
  <body>


    <div class='container my-5 py-5 listing-container'>

        <div class="row">        
            @foreach ($hotels as $hotel)
                <div class="col-md-6 h-listing mb-5">
                    <a href="/detail">
                        <div class="row mx-0">
                            <div class="col-md-6 p-0">
                                <img src="{{asset('img/'.$hotel->image)}}" class='img img-responsive' alt="">
                            </div>
                            <div class="col-md-6 pt-3">
                                <h4>{{$hotel->name}}</h4>
                                <p>{{$hotel->description}}</p>
                            </div>
                       </div>
                    </a>
                </div>            
            @endforeach
        </div>

            <div class="col-md-6 h-listing listing-clone d-none mb-5" >
                <a href="/detail">
                    <div class="row mx-0">
                        <div class="col-md-6 p-0">
                            <img src="{{asset('img/')}}" alt="">
                        </div>
                        <div class="col-md-6 pt-3">
                            <h4></h4>
                            <p></p>
                        </div>
                    </div>
                </a>
           </div>            


    </div>



    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left">    <i class="fas fa-arrow-up"></i>
</a>






    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

<script>
$(document).ready(function () {

    var isfetching = false;

    var listing_limit = 9; 
    window.onscroll = function(ev) {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            if(isfetching == false){
            requestListings()
            }
        }
    };


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


    function requestListings(){
        isfetching = true;
        url = '/fetch';
        var fd = new FormData(this);        
        fd.append('limit', listing_limit)

        request = $.ajax({
            method: "post",
            url: url,
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
        });


        request.done(function (response) {
                if (response) {
                    for (let index = 0; index < response.length; index++) {
                        let newlisting = $('.listing-clone').clone();
                        $(newlisting).removeClass('d-none')
                        $(newlisting).removeClass('listing-clone')
                        let image_link = $(newlisting).find('img').attr('src')
                        image_link = image_link +'/'+ response[index].image
                        $(newlisting).find('img').attr('src',image_link)
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