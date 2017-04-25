<section id="content">
            <div class="container">
                <header class="page-header">
                    <h3>Dashboard </h3>
                </header>
                
                <div class="overview row">
                    <div class="col-md-4 col-sm-6">
                        <div class="o-item bg-cyan">
                            <div class="oi-title">
                                <span data-value="450382"></span>
                                <span>Total Users</span>
                            </div>
                            <h1><?php //echo getAllCount(USERS); ?> 55</h1>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="o-item bg-creat">
                            <div class="oi-title">
                                <span data-value="8737"></span>
                                <span>Last Login</span>
                            </div>
                            <h3 class="last_login"><?php echo convertDateTime($this->session->userdata("last_login")); ?></h3>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="o-item bg-amber">
                            <div class="oi-title">
                                <span data-value="8737"></span>
                                <span>Last IP Address</span>
                            </div>
                            <h3 class="last_login"><?php echo $this->session->userdata("last_ip"); ?></h3>
                        </div>
                    </div>
                   
                </div>

            </div>
        </section>
