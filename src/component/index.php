<?php
function echo_list()
{
    echo '
        <div id="nanoAddressBookContainer">
            <div id="search-box">
                <input id="search-box-int" type="search">
            </div>
        </div>
        <style>
            @font-face{
                font-family: "Source Code Pro", "Consolas";
                unicode-range: U+0000-007F;
            }
            #nanoAddressBookContainer{
                font-family: "Source Code Pro", "Consolas", "Microsoft JhengHei UI", sans-serif;
                font-size: 36px;
                color: #222;
                background: #ddd;
                border: 0;
            }
            #search-box-int{
                height: 2em;
                font-size: 1em;
                width: 100%;
                background: #ddd;
                border: 0;
            }
        </style>
    ';
}