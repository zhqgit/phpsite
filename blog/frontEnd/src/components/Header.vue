<template>
    <header class="row transparent black header1" data-spy="affix" data-offset-top="0" id="header" v-bind:class="{'add-bg':noActive}">
        <div class="container">
            <div class="row top-header">
                <div class="col-sm-4 search-form-col">
                    <form action="#" method="get" class="search-form">
                        <div class="input-group">
                            <span class="input-group-addon"><img src="../assets/images/search-icon-white.png" alt=""></span>
                            <input type="search" class="form-control" placeholder="search">
                        </div>
                    </form>
                </div>
                <div class="col-sm-4 logo-col text-center">
                    <a href="index.html"><img src="../assets/images/logo-white-green.png" alt=""></a>
                </div>
                <div class="col-sm-4 menu-trigger-col">
                    <button class="menu-trigger pull-right">
                        <span class="active-page">home</span>
                        <img src="../assets/images/menu-align-white.png" alt="" class="icon-burger">
                        <img src="../assets/images/menu-close-white.png" alt="" class="icon-cross">
                    </button>
                </div>
            </div>
        </div>
        <div class="row menu-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 menu-col">
                        <div class="row">
                            <ul class="nav column-menu black-bg">
                                <li class="active dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Home <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="index.html">Home Option 1</a></li>
                                        <li><a href="index2.html">Home Option 2</a></li>
                                        <li><a href="index3.html">Home Option 3</a></li>
                                        <li><a href="index4.html">Home Option 4</a></li>
                                        <li><a href="index5.html">Home Option 5</a></li>
                                        <li><a href="index6.html">Home Option 6</a></li>
                                    </ul>
                                </li>
                                <li><a href="about.html">About</a></li>
                                <li><a href="single.html">Blog Single 1</a></li>
                                <li><a href="single2.html">Blog Single 2</a></li>
                            </ul>
                            <ul class="nav column-menu black-bg">
                                <li><a href="single3.html">Blog Single 3</a></li>

                                <li><a href="contact.html">contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4 subscribe-col">
                        <h5 class="widget-title">subscribe to our newsletter.</h5>
                        <form action="#" method="post" class="form-inline subscribe-form">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm"><span>send</span></button>
                        </form>
                        <ul class="nav social-nav dark">
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook-official"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<style>
    @import "../assets/css/style.css";
    @import "../assets/css/theme/green.css";
</style>

<script>

    export default{
        data() {
          return {
              noActive: false,
              scroll: ''
          }
        },
        methods: {
            toggle() {
                this.scroll = document.body.scrollTop;
                if(this.scroll >= 100){
                    this.noActive = !this.noActive;
                    console.log(this.scroll);
                }else {
                    this.noActive = false;
                }
            }
        },
        mounted: function () {
            window.addEventListener('scroll', this.toggle);
        }

    }
</script>


<style>
    @import "../assets/css/style.css";
    @import "../assets/css/theme/green.css";
</style>


