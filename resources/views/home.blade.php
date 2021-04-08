@extends('layout')

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
.img{
    opacity: 0.6;
}
.img{
    opacity: 0.6;
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
                <div class="img">
                <img src="https://images.squarespace-cdn.com/content/v1/5c85a0b8840b16e5e420f6a8/1553388660316-IVLK22CMNOF5P6VATW72/ke17ZwdGBToddI8pDm48kKNHYyweTgIwYtx8b-kby9tZw-zPPgdn4jUwVcJE1ZvWQUxwkmyExglNqGp0IvTJZamWLI2zvYWH8K3-s_4yszcp2ryTI0HqTOaaUohrI8PIvDu85HFtHH0E28VJBR8Yz1NFNxROjz23jYAcYszqeHQKMshLAGzx4R3EDFOm1kBS/french-flower-shop-atlanta" alt="" width="100%" height="600px" fill="#777">
                </div>
                <div class="container">
                <div class="carousel-caption text-left">
                    <h1 style="color: #000; font-weight: 600; font-size: 40px;">DESIGNER BOUQUETS <br> FOR EVERY OCCASION</h1>
                    <p style="color: #000; font-size: 20px;">Show your sincerity to your loved ones.</p>
                    <p><a href="{{ url('/bouquets') }}" class="btn btn-lg btn-dark" role="button" style="margin-bottom: 160px">SHOP NOW <i class="fa fa-arrow-right"></i></a></p>
                </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="img">
                <img src="https://www.appleyardflowers.com/blog/wp-content/uploads/2018/01/valentines2019-blog.jpg" alt="" width="100%" height="600px" fill="#777">
                </div>
                <div class="container">
                <div class="carousel-caption text-left">
                    <h1 style="color: #000; font-weight: 800; font-size: 50px;">MY VALENTINE</h1>
                    <p style="color: #000; font-size: 20px;">Specially made for him or her.</p>
                    <p><a href="{{ url('/bouquets') }}" class="btn btn-lg btn-dark" role="button">SHOP NOW <i class="fa fa-arrow-right"></i></a></p>
                
                </div>
                </div>
            </div>

            <div class="carousel-item">
                <img src="https://www.thetrendspotter.net/wp-content/uploads/2019/07/What-to-Wear-to-Graduation.jpg" alt="" width="100%" height="600px" fill="#777">

                <div class="carousel-caption text-left">
                        <h1 style="color: #FFF; font-weight: 800; font-size: 50px;">HEY GRADUATES!</h1>
                        <p style="font-weight: 800; font-size: 20px;">Express heartfelt joy with our bouquets.</p>
                        <p><a href="{{ url('/bouquets') }}" class="btn btn-lg btn-light" role="button">SHOP COLLECTION <i class="fa fa-arrow-right"></i></a></p>
                </div>
            </div>

            <div class="carousel-item">
            <div class="img">
                <img src="https://resize.indiatvnews.com/en/resize/newbucket/715_-/2020/05/pjimage-13-1588926326.jpg" alt="" width="100%" height="600px" fill="#777">
            </div>
                <div class="container">
                <div class="carousel-caption text-left">
                    <h1 style="color: #000; font-weight: 800; font-size: 50px;">MOTHER'S DAY</h1>
                    <p style="color: #000; font-weight: 800; font-size: 20px;">Express gratitude with us.</p>
                    <p><a href="{{ url('/bouquets') }}" class="btn btn-lg btn-dark" role="button" style="margin-bottom: 130px">SHOP NOW <i class="fa fa-arrow-right"></i></a></p>
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

    <!-- Start of Shop's Value Details -->
    <div class="row">
        <div class="col-sm">
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
                            <td style="border:0;" width="100"><img src="https://cdn.shopify.com/s/files/1/0781/4423/files/bloomthis-icon-vespa-2.png?v=1582274605" style="margin:0 auto;width:100px;"></a></td>
                            <td style="border:0;" width="200">
                            <b class="Heading u-h2"><a>Free Delivery*</a></b><br><a>in KL, Selangor, &amp; JB</a>
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