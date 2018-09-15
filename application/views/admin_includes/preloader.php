<style>
    .preloader-background {
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        -webkit-font-smoothing: antialiased;
        text-rendering: optimizeLegibility;
        -webkit-user-select: none;
        overflow: hidden;
        position: fixed;
        z-index: 1000000;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;	
    }
    * {
        -webkit-transition: all 0.15s;
        -moz-transition: all 0.15s;
        -o-transition: all 0.15s;
        transition: all 0.15s;
    }
    .spinner {
        margin: 100px auto;
        width: 40px;
        height: 40px;
        position: relative;
        text-align: center;
        -webkit-animation: sk-rotate 2.0s infinite linear;
        animation: sk-rotate 2.0s infinite linear;
    }

    .dot1, .dot2 {
        width: 60%;
        height: 60%;
        display: inline-block;
        position: absolute;
        top: 0;
        border-radius: 100%;
        -webkit-animation: sk-bounce 2.0s infinite ease-in-out;
        animation: sk-bounce 2.0s infinite ease-in-out;
    }
    .dot1{
        background-color: #007236;
    }
    .dot2 {
        background-color: #f4d30c;
        top: auto;
        bottom: 0;
        -webkit-animation-delay: -1.0s;
        animation-delay: -1.0s;
    }

    @-webkit-keyframes sk-rotate { 100% { -webkit-transform: rotate(360deg) }}
    @keyframes sk-rotate { 100% { transform: rotate(360deg); -webkit-transform: rotate(360deg) }}

    @-webkit-keyframes sk-bounce {
        0%, 100% { -webkit-transform: scale(0.0) }
        50% { -webkit-transform: scale(1.0) }
    }

    @keyframes sk-bounce {
        0%, 100% { 
            transform: scale(0.0);
            -webkit-transform: scale(0.0);
        } 50% { 
            transform: scale(1.0);
            -webkit-transform: scale(1.0);
        }
    }
</style>
<div class ="preloader-background">
    <div class="spinner">
        <div class="dot1"></div>
        <div class="dot2"></div>
    </div>
</div>