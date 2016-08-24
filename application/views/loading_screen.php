<style>

    #loading-screen-wrapper{
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1000;
        background: rgba(0,0,0,0.3);
        display: none;
    }
    #loader{
        display: block;
        position: relative;
        left: 50%;
        top: 50%;
        width: 150px;
        height: 150px;
        margin: -75px 0 0 -75px;
        z-index: 1001;
    }
</style>
<!--LOADING SCREEN FOR FORM SUBMIT-->
<div id="loading-screen-wrapper">
    <div id="loader" class="animated infinite flip">
        <img src="<?php echo base_url();?>assets/image/logo/Logo_300_V_ppi.png" class="img-responsive"/>
    </div>
</div>