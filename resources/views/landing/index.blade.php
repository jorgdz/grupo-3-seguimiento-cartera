@extends('landing.layout')

@section('title', 'Damplus')

@section('landing')

    @include("partials.header")

    @include("partials.nav")

    <div class="ttr_banner_slideshow"></div>

    @include("partials.slideshow")

    <div class="ttr_banner_slideshow">
    </div>
    <div id="ttr_content_and_sidebar_container">
        <div id="ttr_content">
            <div id="ttr_content_margin" class="container-fluid">
                <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                <div class="ttr_Home_html_row0 row">
                    <div class="post_column col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="ttr_Home_html_column00">
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div class="html_content">
                                <p style="margin:0.14em 0em 0em 0em;text-align:Center;line-height:0.915492957746479;"><span
                                        style="font-family:'Open Sans';font-weight:700;font-size:2em;color:rgba(78,78,78,1);">WELCOME
                                        TO OUR COMPANY</span></p>
                                <p style="margin:0.14em 0em 0em 0em;text-align:Center;line-height:0.915492957746479;"><br
                                        style="font-family:'Open Sans';font-size:1.143em;color:rgba(78,78,78,1);" /></p>
                                <p style="margin:0.14em 0em 0em 0em;text-align:Center;line-height:1.76056338028169;"><span
                                        style="font-family:'Open Sans';font-size:1.143em;color:rgba(78,78,78,1);">Test link
                                        adipiscing elit.Nullam dignissim convallis est.Quisque aliquam </span></p>
                                <p style="margin:0.14em 0em 0em 0em;text-align:Center;line-height:1.76056338028169;"><span
                                        style="font-family:'Open Sans';font-size:1.143em;color:rgba(78,78,78,1);">donec
                                        faucibus.</span></p>
                            </div>
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div class="clearfix visible-lg-block visible-sm-block visible-md-block visible-xs-block">
                    </div>
                </div>
                <div class="ttr_Home_html_row1 row">
                    <div class="post_column col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="ttr_Home_html_column10">
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div class="html_content">
                                <p style="margin:0.5em 0.5em 0.5em 0.5em;text-align:Center;"><img src="{{ asset('assets/landing/images/0.png') }}"
                                        style="max-width:100px;" /></p>
                                <p style="margin:0.5em 0.5em 0.5em 0.5em;text-align:Center;">&nbsp;</p>
                                <p style="margin:0.5em 0em 0.71em 0em;text-align:Center;"><span
                                        style="font-family:'Open Sans';font-weight:700;font-size:1.429em;color:rgba(78,78,78,1);">Aenean
                                        imperdiet Etiam ultricies </span></p>
                                <p style="text-align:Center;line-height:1.76056338028169;"><span
                                        style="font-family:'Open Sans';font-size:1em;color:rgba(78,78,78,1);">Nam eget dui.
                                        Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper
                                        libero, sit amet adipiscing sem neque </span></p>
                            </div>
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div class="clearfix visible-sm-block visible-md-block visible-xs-block">
                    </div>
                    <div class="post_column col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="ttr_Home_html_column11">
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div class="html_content">
                                <p style="margin:0.5em 0.5em 0.5em 0.5em;text-align:Center;"><img src="{{ asset('assets/landing/images/1.png') }}"
                                        style="max-width:100px;" /></p>
                                <p style="margin:0.5em 0.5em 0.5em 0.5em;text-align:Center;">&nbsp;</p>
                                <p style="margin:0.5em 0em 0.71em 0em;text-align:Center;"><span
                                        style="font-family:'Open Sans';font-weight:700;font-size:1.429em;color:rgba(78,78,78,1);">Aenean
                                        imperdiet Etiam ultricies </span></p>
                                <p style="text-align:Center;line-height:1.76056338028169;"><span
                                        style="font-family:'Open Sans';font-size:1em;color:rgba(78,78,78,1);">Nam eget dui.
                                        Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper
                                        libero, sit amet adipiscing sem neque.</span></p>
                            </div>
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div class="clearfix visible-sm-block visible-md-block visible-xs-block">
                    </div>
                    <div class="post_column col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="ttr_Home_html_column12">
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div class="html_content">
                                <p style="margin:0.5em 0.5em 0.5em 0.5em;text-align:Center;"><img src="{{ asset('assets/landing/images/2.png') }}"
                                        style="max-width:100px;" /></p>
                                <p style="margin:0.5em 0.5em 0.5em 0.5em;text-align:Center;">&nbsp;</p>
                                <p style="margin:0.5em 0em 0.71em 0em;text-align:Center;"><span
                                        style="font-family:'Open Sans';font-weight:700;font-size:1.429em;color:rgba(78,78,78,1);">Aenean
                                        imperdiet Etiam ultricies </span></p>
                                <p style="text-align:Center;line-height:1.76056338028169;"><span
                                        style="font-family:'Open Sans';font-size:1em;color:rgba(78,78,78,1);">Nam eget dui.
                                        Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper
                                        libero, sit amet adipiscing sem neque.</span></p>
                            </div>
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div class="clearfix visible-lg-block visible-sm-block visible-md-block visible-xs-block">
                    </div>
                </div>
                <div class="ttr_Home_html_row2 row">
                    <div class="post_column col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="ttr_Home_html_column20">
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div class="html_content">
                                <p style="margin:0em 0em 0.71em 0em;text-align:Center;"><span
                                        style="font-family:'Open Sans';font-weight:700;font-size:2em;color:rgba(213,67,83,1);">Maecenas
                                        tempus tellus eget</span></p>
                                <p style="text-align:Center;"><span
                                        style="font-family:'Open Sans';font-size:1.143em;color:rgba(78,78,78,1);">Aenean
                                        vulputate eleifend tellus. Aenean leo ligula porttitor eu eleifend tellus.</span>
                                </p>
                            </div>
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div class="clearfix visible-lg-block visible-sm-block visible-md-block visible-xs-block">
                    </div>
                </div>
                <div class="ttr_Home_html_row3 row">
                    <div class="post_column col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="ttr_Home_html_column30">
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div class="html_content">
                                <p style="margin:0em 0em 0em 2.86em;"><span class="ttr_image"
                                        style="float:Left;overflow:hidden;margin:0em 1.79em 0em 0em;"><span><img
                                                class="ttr_uniform" src="/assets/landing/images/3.png"
                                                style="max-width:350px;max-height:233px;" /></span></span><span
                                        style="font-family:'Open Sans';font-weight:700;font-size:1.286em;color:rgba(78,78,78,1);">Aenean
                                        vulputate eleifend tellus. Aenean leo ligula. </span></p>
                                <p style="margin:0em 0em 0em 2.86em;line-height:1.54929577464789;"><br
                                        style="font-family:'Open Sans';font-size:1em;color:rgba(52,52,52,1);" /></p>
                                <p style="margin:0em 0em 0em 2.86em;line-height:1.54929577464789;"><span
                                        style="font-family:'Open Sans';font-size:1em;color:rgba(78,78,78,1);">Porttitor eu,
                                        consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibusin, viverra quis,
                                        feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                                        Aenean imperdiet. Etiam ultricies nisi velaugueCurabiturullamcorper ultricies nisi.
                                        Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem
                                        quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, landit
                                        el, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt
                                        tempus. </span></p>
                                <p style="margin:0em 0em 0em 1.43em;line-height:1.54929577464789;"><br
                                        style="font-family:'Open Sans';font-size:1em;color:rgba(78,78,78,1);" /></p>
                                <p style="margin:0em 0em 0em 2.86em;line-height:1.54929577464789;"><span><a HREF="#"
                                            target="_self" class="btn btn-md btn-success">READ MORE</a></span></p>
                            </div>
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div class="clearfix visible-lg-block visible-sm-block visible-md-block visible-xs-block">
                    </div>
                </div>
                <div class="ttr_Home_html_row4 row">
                    <div class="post_column col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="ttr_Home_html_column40">
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div class="html_content">
                                <p style="margin:0em 0em 2.14em 0em;text-align:Center;"><span
                                        style="font-family:'Open Sans';font-weight:700;font-size:2em;color:rgba(78,78,78,1);">Aenean
                                        vulputate eleifend tellus. </span><br
                                        style="font-family:'Open Sans';font-size:1.143em;color:rgba(78,78,78,1);" /></p>
                                <p style="text-align:Center;"><span
                                        style="font-family:'Open Sans';font-size:1.143em;color:rgba(78,78,78,1);">Aenean leo
                                        ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante,
                                        dapibusin, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius
                                        reet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi</span></p>
                            </div>
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div class="clearfix visible-lg-block visible-sm-block visible-md-block visible-xs-block">
                    </div>
                </div>
                <div class="ttr_Home_html_row5 row">
                    <div class="post_column col-lg-5 col-md-12 col-sm-12 col-xs-12">
                        <div class="ttr_Home_html_column50">
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div class="html_content">
                                <p style="margin:0em 0em 0.71em 0em;line-height:1.33802816901408;"><span class="ttr_image"
                                        style="float:Left;overflow:hidden;margin:0em 1.79em 0em 0em;"><span><img
                                                class="ttr_uniform" src="{{ asset('assets/landing/images/4.png') }}"
                                                style="max-width:70px;max-height:70px;" /></span></span><span
                                        style="font-family:'Open Sans';font-weight:700;font-size:1.143em;color:rgba(78,78,78,1);">Aenean
                                        vulputate eleifend tellus. </span><br
                                        style="font-family:'Open Sans';font-size:1em;color:rgba(78,78,78,1);" /></p>
                                <p style="margin:0em 0em 0.71em 0em;line-height:1.33802816901408;"><span
                                        style="font-family:'Open Sans';font-size:1em;color:rgba(78,78,78,1);">Aenean leo
                                        ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante,
                                        dapibusin, viverra quis.</span></p>
                                <p style="margin:2.14em 0em 0.36em 0em;"><span class="ttr_image"
                                        style="float:Left;overflow:hidden;margin:0em 1.43em 0em 0em;"><span><img
                                                class="ttr_uniform" src="{{ asset('assets/landing/images/5.png') }}"
                                                style="max-width:70px;max-height:70px;" /></span></span><span
                                        style="font-family:'Open Sans';font-weight:700;font-size:1.143em;color:rgba(78,78,78,1);">Donec
                                        vitae sapien ut libero faucibus. </span></p>
                                <p style="margin:0em 0em 0.36em 0em;line-height:1.54929577464789;"><span
                                        style="font-family:'Open Sans';font-size:1em;color:rgba(78,78,78,1);">Nullam quis
                                        ante. Etiam sit amet orci eget eros faucibus tincidunt. Maecenas tempus, tellus eget
                                        condimentum rhoncus,</span></p>
                                <p style="margin:2.14em 0em 0.36em 0em;"><span class="ttr_image"
                                        style="float:Left;overflow:hidden;margin:0em 1.43em 0em 0em;"><span><img
                                                class="ttr_uniform" src="{{ asset('assets/landing/images/6.png') }}"
                                                style="max-width:70px;max-height:70px;" /></span></span><span
                                        style="font-family:'Open Sans';font-weight:700;font-size:1.143em;color:rgba(78,78,78,1);">In
                                        enim justo, rhoncus ut,imperdiet. </span></p>
                                <p style="margin:0em 0em 0.36em 0em;line-height:1.54929577464789;"><span
                                        style="font-family:'Open Sans';font-size:1em;color:rgba(78,78,78,1);">venenatis
                                        vitae, justo. Nullam dictum felis eu pede&nbsp;&nbsp;pretium. Integer
                                        tincidunt.</span></p>
                            </div>
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div class="clearfix visible-sm-block visible-md-block visible-xs-block">
                    </div>
                    <div class="post_column col-lg-7 col-md-12 col-sm-12 col-xs-12">
                        <div class="ttr_Home_html_column51">
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div class="html_content">
                                <p style="margin:0em 0em 0em 0em;line-height:2.8169014084507;"><span
                                        style="font-family:'Open Sans';font-size:1.857em;color:rgba(213,67,83,1);">Donec
                                        quam felis, ultricies nec, </span></p>
                                <p style="margin:0em 0em 0em 0em;line-height:2.8169014084507;"><span
                                        style="font-family:'Open Sans';font-weight:700;font-size:1.857em;color:rgba(78,78,78,1);">pellentesque
                                        eu,pretium quis, sem.</span><span
                                        style="font-family:'Open Sans';font-size:1.857em;color:rgba(78,78,78,1);"> </span>
                                </p>
                                <p style="margin:0em 0em 0em 0em;line-height:1.54929577464789;"><br
                                        style="font-family:'Open Sans';font-size:1em;color:rgba(78,78,78,1);" /></p>
                                <p style="margin:0em 0em 0em 0em;line-height:2.04225352112676;"><span
                                        style="font-family:'Open Sans';font-size:1em;color:rgba(78,78,78,1);">Nulla
                                        consequat massa quis enim.Donec pede justo,fringilla vel, aliquet nec, vulputate
                                        eget, arcu rh oncus ut,imperdiet a, venenatis vitae, justo. Nullam dictum felis eu
                                        pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.
                                        Aenean vulputate eleifend tellus. Aenean eoigula, porttitor eu, consequat vitae,
                                        eleifend ac, enim. Aliquam lorem ante, dapibusin, viverra quis, ugiat a, tellus.
                                        Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet.
                                        Etiam ultricies nisi velaugue.Curabiturullamcorper ultricies nisi.</span></p>
                                <p style="margin:0em 0em 0em 4.29em;line-height:1.54929577464789;"><br
                                        style="font-family:'Open Sans';font-size:1em;" /></p>
                                <p style="margin:0em 0em 0em 4.29em;line-height:1.54929577464789;"><span><a href="#"
                                            target="_self" class="btn btn-lg btn-primary">MORE INFO</a>&nbsp;&nbsp; <span><a
                                                HREF="#" target="_self"
                                                class="btn btn-md btn-success">CONNECT</a></span></span></p>
                            </div>
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div class="clearfix visible-lg-block visible-sm-block visible-md-block visible-xs-block">
                    </div>
                </div>
                <div class="ttr_Home_html_row6 row">
                    <div class="post_column col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="ttr_Home_html_column60">
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div class="html_content">
                                <p style="margin:0em 0em 0em 2.86em;line-height:2.8169014084507;"><span
                                        style="font-family:'Open Sans';font-size:1.857em;color:rgba(213,67,83,1);">Nullam
                                        dictum felis eu </span></p>
                                <p style="margin:0em 0em 0em 2.86em;line-height:2.8169014084507;"><span
                                        style="font-family:'Open Sans';font-weight:700;font-size:1.857em;color:rgba(78,78,78,1);">Pede
                                        mollis pretium.</span></p>
                            </div>
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div class="clearfix visible-sm-block visible-md-block visible-xs-block">
                    </div>
                    <div class="post_column col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <div class="ttr_Home_html_column61">
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div class="html_content">
                                <p style="margin:0em 0em 0em 2.86em;line-height:2.04225352112676;"><span
                                        style="font-family:'Open Sans';font-size:1em;color:rgba(78,78,78,1);">Lorem ipsum
                                        dolor sit amet, consectetuer adipiscing elit. Aenean commodoligula eget dolor.Aenean
                                        massa. Cum sociis natoque. penatibus et magnis dis parturient montes,nascetur
                                        ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu,pretium quis sem.
                                        Nulla consequat massa quis enim.Donec pede justo,fringilla vel, aliquet nec,
                                        vulputate eget, arcu. In enim justo, rhoncus penatibus et magnis dis parturient
                                        montes,nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque
                                        eu,pretium quis.</span></p>
                            </div>
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div class="clearfix visible-lg-block visible-sm-block visible-md-block visible-xs-block">
                    </div>
                </div>
                <div class="ttr_Home_html_row7 row">
                    <div class="post_column col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="ttr_Home_html_column70">
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div class="html_content">
                                <p style="margin:0em 0em 0em 0em;text-align:Center;"><img src="{{ asset('assets/landing/images/7.jpg') }}"
                                        style="max-width:250px;" /></p>
                                <p style="margin:0em 0em 0em 0em;text-align:Center;"><br
                                        style="font-family:'Open Sans';font-weight:700;font-size:1em;" /></p>
                                <p style="margin:0em 0em 0em 0em;text-align:Center;line-height:1.54929577464789;"><span
                                        style="font-family:'Open Sans';font-weight:700;font-size:1.071em;color:rgba(78,78,78,1);">Aenean
                                        massa. Cum natoque. </span><span
                                        style="font-family:'Open Sans';font-size:1em;color:rgba(78,78,78,1);">penatibus et
                                        magnis dis parturient montes,nascetur ridiculus mus.</span></p>
                                <p style="margin:0em 0em 0em 0em;text-align:Center;">&nbsp;</p>
                                <p style="margin:0em 0em 0em 0em;text-align:Center;">&nbsp;</p>
                            </div>
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div class="clearfix visible-xs-block">
                    </div>
                    <div class="post_column col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="ttr_Home_html_column71">
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div class="html_content">
                                <p style="margin:0em 0em 0em 0em;text-align:Center;"><img src="{{ asset('assets/landing/images/8.jpg') }}"
                                        style="max-width:250px;" /></p>
                                <p style="margin:0em 0em 0em 0em;text-align:Center;"><br
                                        style="font-family:'Open Sans';font-weight:700;font-size:1em;" /></p>
                                <p style="margin:0em 0em 0em 0em;text-align:Center;line-height:1.54929577464789;"><span
                                        style="font-family:'Open Sans';font-weight:700;font-size:1.071em;color:rgba(78,78,78,1);">Aenean
                                        massa. Cum natoque. </span><span
                                        style="font-family:'Open Sans';font-size:1em;color:rgba(78,78,78,1);">penatibus et
                                        magnis dis parturient montes,nascetur ridiculus mus.</span></p>
                                <p style="margin:0em 0em 0em 0em;text-align:Center;">&nbsp;</p>
                                <p style="margin:0em 0em 0em 0em;text-align:Center;">&nbsp;</p>
                            </div>
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div class="clearfix visible-sm-block visible-md-block visible-xs-block">
                    </div>
                    <div class="post_column col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="ttr_Home_html_column72">
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div class="html_content">
                                <p style="margin:0em 0em 0em 0em;text-align:Center;"><img src="{{ asset('assets/landing/images/9.jpg') }}"
                                        style="max-width:250px;" /></p>
                                <p style="margin:0em 0em 0em 0em;text-align:Center;"><br
                                        style="font-family:'Open Sans';font-weight:700;font-size:1em;" /></p>
                                <p style="margin:0em 0em 0em 0em;text-align:Center;line-height:1.54929577464789;"><span
                                        style="font-family:'Open Sans';font-weight:700;font-size:1.071em;color:rgba(78,78,78,1);">Aenean
                                        massa. Cum natoque. </span><span
                                        style="font-family:'Open Sans';font-size:1em;color:rgba(78,78,78,1);">penatibus et
                                        magnis dis parturient montes,nascetur ridiculus mus.</span></p>
                                <p style="margin:0em 0em 0em 0em;text-align:Center;">&nbsp;</p>
                                <p style="margin:0em 0em 0em 0em;text-align:Center;">&nbsp;</p>
                            </div>
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div class="clearfix visible-xs-block">
                    </div>
                    <div class="post_column col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="ttr_Home_html_column73">
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div class="html_content">
                                <p style="margin:0em 0em 0em 0em;text-align:Center;"><img src="{{ asset('assets/landing/images/10.jpg') }}"
                                        style="max-width:250px;" /></p>
                                <p style="margin:0em 0em 0em 0em;text-align:Center;"><br
                                        style="font-family:'Open Sans';font-weight:700;font-size:1em;" /></p>
                                <p style="margin:0em 0em 0em 0em;text-align:Center;line-height:1.54929577464789;"><span
                                        style="font-family:'Open Sans';font-weight:700;font-size:1.071em;color:rgba(78,78,78,1);">Aenean
                                        massa. Cum natoque. </span><span
                                        style="font-family:'Open Sans';font-size:1em;color:rgba(78,78,78,1);">penatibus et
                                        magnis dis parturient montes,nascetur ridiculus mus.</span></p>
                                <p style="margin:0em 0em 0em 0em;text-align:Center;"><br
                                        style="font-family:'Open Sans';font-size:1em;" /></p>
                                <p style="margin:0em 0em 0em 0em;text-align:Center;"><br
                                        style="font-family:'Open Sans';font-size:1em;" /></p>
                            </div>
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div class="clearfix visible-lg-block visible-sm-block visible-md-block visible-xs-block">
                    </div>
                </div>
                <div class="ttr_Home_html_row8 row">
                    <div class="post_column col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="ttr_Home_html_column80">
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div class="html_content">
                                <p style="margin:0em 0em 0em 2.86em;line-height:1.76056338028169;"><span
                                        style="font-family:'Open Sans';font-size:1.857em;color:rgba(213,67,83,1);">Lorem
                                        ipsum dolor sit amet. </span></p>
                                <p style="margin:0em 0em 0em 2.86em;line-height:1.76056338028169;"><span
                                        style="font-family:'Open Sans';font-weight:700;font-size:1.857em;color:rgba(78,78,78,1);">Consectuer
                                        adipiscing elit. </span></p>
                                <p style="margin:0em 0em 0em 2.86em;line-height:1.76056338028169;"><br
                                        style="font-family:'Open Sans';color:rgba(78,78,78,1);" /></p>
                                <p style="margin:0em 0em 0em 2.86em;line-height:2.04225352112676;"><span
                                        style="font-family:'Open Sans';font-size:1em;color:rgba(78,78,78,1);">Aenean
                                        commodoligula eget dolor.Aenean massa. Cum sociis natoque. penatibus et magnis dis
                                        parturient montes,nascetur ridiculus mus. Donec quam felis, ultricies nec,
                                        pellentesque eu,pretium quis, sem. Nulla consequat massa quis enim.Donec pede
                                        justo,fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus
                                        ut,imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
                                        Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate
                                        eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac,
                                        enim. Aliquam lorem ante, dapibusin, viverra quis, feugiat a, tellus. Phasellus
                                        viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam
                                        ultricies nisi.</span></p>
                            </div>
                            <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div class="clearfix visible-lg-block visible-sm-block visible-md-block visible-xs-block">
                    </div>
                </div>
                <div style="height:0px;width:0px;overflow:hidden;-webkit-margin-top-collapse: separate;"></div>
            </div>
        </div>
        <div style="clear:both">
        </div>
    </div>
    @endsection
