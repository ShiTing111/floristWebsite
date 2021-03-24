@extends('layouts.app')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection


@section('content')
<style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .carousel-item-next, .carousel-item-prev, .carousel-item.active {
    display: block;
}
.carousel-item {
    height: 32rem;
}
.carousel-item {
    position: relative;
    display: none;
    float: left;
    width: 100%;
    height: 600px;
    margin-right: -100%;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    transition: -webkit-transform .6s ease-in-out;
    transition: transform .6s ease-in-out;
    transition: transform .6s ease-in-out,-webkit-transform .6s ease-in-out;
}
/*addias*/
.color-theme-white___3NDJn h2, .color-theme-white___3NDJn p {
    color: #fff;
}
.title___DZ13z {
    margin-bottom: 15px;
    font-size: 16px;
}
.gl-heading--s, h5 {
    font-size: 18px;
    line-height: 16px;
}
.gl-heading, h1, h2, h3, h4, h5, h6 {
    letter-
    spacing: 1.5px;
}
h2{
    font-style: normal;
    font-weight: 600;
    font-family: 'Abel', sans-serif;
}
h2 a{
    color: #fff;
}
h2 a:hover{
    color: #fff;
}
/*online shop*/
.add2_text{
    color: #000;
}
.img_feature{
    margin-right: 100px;
    margin-bottom: 10px;
}
.feature_cat{
    font-size: 24px;
}
h5{
    font-weight: bold;
    font-size: 20px;
    text-transform: uppercase;
}
.home_con{
    height: 170px;
    background-color: #ede734;
    color: #000;
}
h4{
    font-weight: bold;
    font-size: 22px;
    text-transform: uppercase;
    font-family: 'adiBlack',Arial,Helvetica,Verdana,sans-serif;
}

.caro3_3{
  margin-right: 70px;
  margin-left: 30px;
}
.caro3{
  margin: 10px;

}
.caro3_img{
  width: 470px;

}
</style>
<div class="container">

<main role="main">
    
    <!-- Carousel -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">

                <img src="https://brand.assets.adidas.com/image/upload/f_auto,q_auto,fl_lossy/enUS/Images/running-fw19-rfto-educate-hp-lf-mh-medium-d_tcm221-356981.jpg" alt="" width="100%" height="600px" fill="#777">
                <div class="container">
                <div class="carousel-caption text-left">
                    <h1 style="color: #000; font-weight: 600;">RUN FOR THE OCEANS</h1>
                    <p style="color: #000;">It's time to take action against marine plastic pollution. Rally your <br>friends to join the movement.</p>
                    <p><a class="btn btn-lg btn-dark" role="button" style="margin-bottom: 160px">LEARN MORE <i class="fa fa-arrow-right"></i></a></p>
                </div>
                </div>
            </div>
            <div class="carousel-item">

                <img src="https://image.adidas.co.kr/upload/banner/bbf2598bfc7c4a2ba1f8aad25b494123_0429163854.jpg" alt="" width="100%" height="600px" fill="#777">
                <div class="container">
                <div class="carousel-caption text-left">
                    <h1 style="color: #000; font-weight: 600;">For Women,<br>Give Love & Thanks</h1>
                        
                    <p style="color: #000;">Light up the night in new Nite Jogger colorways. Photo by Cole Younger.</p>
                    <p><a class="btn btn-lg btn-dark" role="button">SHOP NOW <i class="fa fa-arrow-right"></i></a></p>
                    <p><a class="btn btn-lg btn-dark" role="button" style="margin-bottom: 120px">VIEW MEMBER BENEFITS <i class="fa fa-arrow-right"></i></a></p>
                
                </div>
                </div>
            </div>

            <div class="carousel-item">
                <img src="https://brand.assets.adidas.com/image/upload/f_auto,q_auto,fl_lossy/enUS/Images/training-aSMC-ss20-mh-earthday-image2-d_tcm221-485018.jpg" alt="" width="100%" height="600px" fill="#777">

                <div class="carousel-caption text-left">
                        <h1>HEY WORLD!</h1>
                        <p>Earth Day is Every Day, the new collection that respects and celebrates our planet.</p>
                        <p><a class="btn btn-lg btn-light" role="button">SHOP COLLECTION <i class="fa fa-arrow-right"></i></a></p>
                </div>
            </div>

            <div class="carousel-item">
                <img src="https://content.nike.com/content/dam/one-nike/en_lu/SU19/Mens/W_20190516_EMEA_NSW_MLP_P3A_SHOX/W_20190516_EMEA_NSW_MLP_P3A_SHOX_DT_1600x600_visual.jpg.transform/full-screen/W_20190516_EMEA_NSW_MLP_P3A_SHOX_DT_1600x600_visual.jpg" alt="" width="100%" height="600px" fill="#777">

                <div class="container">
                <div class="carousel-caption text-left">
                    <h1>KICK UP A STORM IN SHOX</h1>
                    <p>The subversive Nike Shox R4 is making<br>
                        waves in clean monochrome colourways.</p>
                    <p><a class="btn btn-lg btn-light" role="button" style="margin-bottom: 130px">SHOP NOW <i class="fa fa-arrow-right"></i></a></p>
                </div>
            </div>
        </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- End of Carousel -->
    <br><br>
   <!-- Start of Shops Details -->
    <div class="row">
        <div class="col-md-6 col-xs-12 col-sm-11">
            <img src="https://brand.assets.adidas.com/image/upload/f_auto,q_auto,fl_lossy/enUS/Images/MOVED_OVER_tcm221-363900.jpg" width="550px" height="500px">

            <div class="container">
                <div class="carousel-caption">
                    <h2>ULTRABOOST 19</h2>
                    <p>Reboosted</p>
                    <p><a class="btn btn-lg btn-light" href="#" role="button">SHOP NOW <i class="fa fa-arrow-right"></i></a></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12 col-sm-11">
            <img src="https://brand.assets.adidas.com/image/upload/f_auto,q_auto,fl_lossy/enUS/Images/originals-fw19-hoc-drop1-tease-hp-teaser-large-2up-ee5790-m-t_v2_tcm221-364940.jpg" width="550px" height="500px">
            <div class="container">
        <div class="carousel-caption">
            <h2>HOME OF CLASSICS</h2>
            <p><a class="btn btn-lg btn-light" href="#" role="button">PREVIEW NOW <i class="fa fa-arrow-right"></i></a></p>
        </div>
        </div>
        </div>
    </div>
    <!-- End of Shops Details -->
    <br><br>

    <!-- Start of Shop's Value Details -->
    <div class="row">
        <div class="col-sm" style="text-align: center">
                <div class="TableWrapper">
                    <table>
                        <tbody>
                        <tr>
                            <td style="border:0;" width="100"><img src="https://cdn.shopify.com/s/files/1/0781/4423/files/bloomthis-icon-just-because-2.png?v=1582274605" style="margin:0 auto;width:100px;"></td>
                            <td style="border:0;" width="200">
                            <b class="Heading u-h2">Luxurious Design</b><br>in bespoke gift wraps &amp; boxes</td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm">
                <div class="TableWrapper">
                    <table>
                        <tbody>
                        <tr>
                            <td style="border:0;" width="100"><img src="https://cdn.shopify.com/s/files/1/0781/4423/files/bloomthis-icon-flowers-2.png?v=1582274605" style="margin:0 auto;width:100px;"></td>
                            <td style="border:0;" width="200">
                            <b class="Heading u-h2">Quality Flowers</b><br>from the best flower growers</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm">
                <div class="TableWrapper">
                    <table>
                        <tbody>
                        <tr>
                            <td style="border:0;" width="100"><a href="/pages/delivery-information" target="_blank"><img src="https://cdn.shopify.com/s/files/1/0781/4423/files/bloomthis-icon-vespa-2.png?v=1582274605" style="margin:0 auto;width:100px;"></a></td>
                            <td style="border:0;" width="200">
                            <b class="Heading u-h2"><a href="/pages/delivery-information" target="_blank">Free Delivery*</a></b><br><a href="/pages/delivery-information" target="_blank">in KL, Selangor, Penang &amp; JB</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Shop's Value Details -->
</main>

</div>
@endsection
