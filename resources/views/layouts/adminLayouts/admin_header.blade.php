<div id="user">
</div>

<div id="container2">
    <div id="user-nav" >
        <ul class="nav" style="padding-top:10px; border-right: 0px solid #2e363f; border-left: 0px solid #2e363f;" >
            <li id="site_logo" style="float:left;border-right: 0px solid #2e363f; border-left: 0px solid #2e363f;">
                <img width="170" src="" alt="site_logo" title="site_logo">
            </li>
            <li style="float:right; padding-right:10px; border-right: 0px solid #2e363f; border-left: 0px solid #2e363f;">
                <a style="color:white; border: 1px solid rgba(255,255,255,0.7); border-radius: 100px;" href="{{ url('/logout') }}">
                    <i  class="icon icon-share-alt icon-large"></i> <span class="text">Log out</span></a>
            </li>

            <li style="float:right; padding-right:10px; border-right: 0px solid #2e363f; border-left: 0px solid #2e363f; padding-top: 10px;">
                <span class="text" style="color:white;">Hello! {{ Auth::user()->name }}</span>
            </li>
        </ul>
    </div>
</div>
