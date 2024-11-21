@extends('base.main')
@section('content')

<body>
            <div class="container-fluid dashboard-content">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Slides with Captions</h5>
                            <div class="card-body">
                                <div id="carouselExampleIndicators1" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleIndicators1" data-slide-to="0" class="active"></li>
                                        <li data-target="#carouselExampleIndicators1" data-slide-to="1"></li>
                                        <li data-target="#carouselExampleIndicators1" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100" src="../assets/images/ad.jpg" alt="First slide">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h3 class="text-white">Heading Title Carousel</h3>
                                                <p>Mauris fermentum elementum ligula in efficitur. Aliquam id congue lorem. Proin consectetur feugiat enim ut luctus. Aliquam pellentesque ut tellus ultricies bibendum.</p>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100" src="../assets/images/book.png" alt="Second slide">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h3 class="text-white">Heading Title Carousel</h3>
                                                <p>Mauris fermentum elementum ligula in efficitur. Aliquam id congue lorem. Proin consectetur feugiat enim ut luctus. Aliquam pellentesque ut tellus ultricies bibendum.</p>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100" src="../assets/images/ma.png" alt="Third slide">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h3 class="text-white">Heading Title Carousel</h3>
                                                <p>Mauris fermentum elementum ligula in efficitur. Aliquam id congue lorem. Proin consectetur feugiat enim ut luctus. Aliquam pellentesque ut tellus ultricies bibendum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators1" role="button" data-slide="prev">
                                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                       <span class="sr-only">Previous</span>  </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators1" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>  </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</body>

@endsection
