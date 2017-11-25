<?php
function echo_list()
{
    echo '
        <div id="nanoAddressBookContainer">
            <div id="search-box">
                <svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" id="search-icon-svg">
                    <g>
                        <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z">
                        </path>
                    </g>
                </svg>
                <input id="search-box-int" type="search">
            </div>
        </div>
        <style>
            @font-face{
                font-family: "Source Code Pro", "Consolas";
                unicode-range: U+0000-007F;
            }
            #nanoAddressBookContainer, input{
                font-family: "Source Code Pro", "Consolas", "Microsoft JhengHei UI", sans-serif;
            }
            #nanoAddressBookContainer{
                font-size: 36px;
                width: 100%;
                height: 100%;
                color: #888;
                background: #f1f1f1;
                border: 0;
            }
            #search-box{
                padding: 0 0.8em 0 2em;
                background: #3668dd;
                color: inherit;
            }
            #search-icon-svg path{
                fill: #fff
            }
            #search-icon-svg{
                width: 1.4em;
                height: 1.4em;
                position: absolute;
                top: 0.3em;
                left: 0.3em;
            }
            #search-box-int{
                height: 2em;
                font-size: 1em;
                width: 100%;
                outline: none;
                color: #fff;
                background: inherit;
                border: 0;
            }
        </style>
        <script>
            window.onload = function(){
                var fontSize = (window.innerHeight/743 * 36).toString() + "px";
                console.log(fontSize);
                document.getElementById("nanoAddressBookContainer").style.fontSize = fontSize;
            }
        </script>
    ';
}