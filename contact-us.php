<?php
require('inc/header.php');
?>
<div id="contact-page" class="container">
    <div class="bg">

        <div class="row">
            <div class="col-sm-8">
                <div class="contact-form">
                    <h2 class="title text-center">Liên hệ</h2>
                    <div class="status alert alert-success" style="display: none"></div>
                    <form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
                        <div class="form-group col-md-6">
                            <input type="text" name="name" class="form-control" required="required" placeholder="Tên">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" name="email" class="form-control" required="required" placeholder="Email">
                        </div>
                        
                        <div class="form-group col-md-12">
                            <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Để lại câu hỏi"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name="submit" class="btn btn-primary pull-right" value="Gửi">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="contact-info">
                    <h2 class="title text-center">Thông tin liên lạc</h2>
                    <address>
                        <p>NT-FASHION Inc.</p>
                        <p>Bá Hiến, Bình Xuyên, Vĩnh Phúc</p>
                        <p>Việt Nam</p>
                        <p>SĐT: +84 965882491</p>
                        <p>Email: nangvipvp02@gmail.com</p>
                    </address>
                    <div class="social-networks">
                        <h2 class="title text-center">Mạng xã hội</h2>
                        <ul>
                            <li>
                                <a href="https://www.facebook.com/tavannang02/"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="https://twitter.com/TVnNng3"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="https://www.youtube.com/channel/UCGs4fIRLyrOa3GBW6lJa_Gw"><i class="fa fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h2 class="title text-center">Liên hệ với chúng tôi</h2>
                <div id="gmap" class="contact-map">
                    <iframe width="600" height="350" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d929.2119646709285!2d105.6848408!3d21.3170272!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3134e52ff68c7cfd%3A0xecf0c5972054065!2zTmjDoCBOZ2jhu4kgNTY!5e0!3m2!1svi!2s!4v1636656737289!5m2!1svi!2s">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/#contact-page-->
<?php
require('inc/footer.php');
?>