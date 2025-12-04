<header>
    <div class="header-top-area bg-area">
        <div class="container">
            <div class="header-top">
                <div class="header-logo">
                    <a href="index.html"><img src="{{ url('assets/frontend/images/logo.png') }}" alt=""></a>
                </div>
                <div class="header-search d-flex">
                    <input type="text" placeholder="Search">
                    <div class="search-icon">
                        <a href="#"> <i class="fas fa-search"></i></a>
                    </div>
                </div>

                <div class="header-right">
                    <div class="icon-cards">
                        <div class="header-right-icon">
                            <a href="#"><i class="fas fa-user"></i></a>
                        </div>
                        <div class="header-right-content">
                            <a href="#">
                                <h3>Profile</h3>
                            </a>
                        </div>
                    </div>
                    <div class="icon-cards">
                        <div class="header-right-icon">
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                        <div class="header-right-content">
                            <a href="#">
                                <h3>Message</h3>
                            </a>
                        </div>
                    </div>
                    <div class="icon-cards">
                        <div class="header-right-icon">

                            <a href="#"><i class="fas fa-heart"></i></a>
                        </div>
                        <div class="header-right-content">
                            <a href="#">
                                <h3>Order</h3>
                            </a>
                        </div>
                    </div>

                    <div class="icon-cards">
                        <div class="header-right-icon">
                            <a href="#"><i class="fas fa-cart-plus"></i></a>
                        </div>
                        <div class="header-right-content">
                            <a href="#">
                                <h3>My Cart</h3>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- navber section start  -->
    <div class="teach-top-area bg-area">
        <div class="container"><input type="checkbox" id="menu-bar">
            <!-- mb header start  -->
            <div class="mb-header-tab">
                <label for="menu-bar">
                    <i class="fa fa-bars"></i>
                </label>
                <div class="mb-header-logo">
                    <img src="{{ url('assets/frontend/images/logo.png') }}" alt="">
                </div>
                <div class="mb-header-icon d-flex">
                    <div class="mbsearch d-flex">
                        <i class="fa fa-search search"></i>
                        <input type="text" placeholder="Search" id="search">
                    </div>
                </div>
            </div>

            <nav class="navber ">
                <ul>
                    <li>
                        <a href="product.html" class="menu ">All Product</a>
                    </li>
                    <li>
                        <a href="# " class="menu ">Hot offers</a>
                    </li>
                    <li>
                        <a href="# " class="menu ">Projects</a>
                    </li>
                    <li>
                        <a href="software.html" class="menu ">Software</a>
                    </li>
                    <li>
                        <a href="blog.html" class="menu ">Blog</a>
                    </li>
                    <li>
                        <a href="contact.html" class="menu ">Contact</a>
                    </li>

                    <!-- laptop drop-down start  -->
                    <!-- <li>
                        <select id="input-zone ">
                            <i class="fa-solid fa-cart-shopping "></i>
                            <option value=" ">Help</option>
                            <option value=" ">Help 1</option>
                            <option value=" ">Help 2</option>
                            <option value=" ">Help 3</option>
                        </select>
                    </li> -->
                </ul>
                <ul>
                    <!--  drop-down start  -->
                    <li>
                        <select id="input-zone ">
                            <option value=" ">Bangla</option>
                            <option value=" ">English</option>
                        </select>
                    </li>
                    <li>
                        <a href="# ">Ship to</a>
                    </li>
                    <li>
                        <select id="input-zone ">
                            <option value=" ">Bangladesh</option>
                            <option value=" ">India</option>
                            <option value=" ">China</option>
                            <option value=" ">Japan</option>
                            <option value=" ">Indoneshia</option>
                        </select>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>