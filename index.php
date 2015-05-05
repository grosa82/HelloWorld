<?php include "header.php" ?>

<div data-ride="carousel" class="carousel slide" id="carousel">
    <ol class="carousel-indicators">
        <li class="" data-slide-to="0" data-target="#carousel"></li>
        <li data-slide-to="1" data-target="#carousel" class="active"></li>
        <li data-slide-to="2" data-target="#carousel" class=""></li>
    </ol>
    <div role="listbox" class="carousel-inner">
        <div class="item active left">
            <img alt="Photo 1" data-src="holder.js/1140x500/auto/#777:#555/text:First slide" src="1.jpg" data-holder-rendered="true" />
        </div>
        <div class="item next left">
            <img alt="Photo 2" data-src="holder.js/1140x500/auto/#666:#444/text:Second slide" src="2.jpg" data-holder-rendered="true" />
        </div>
        <div class="item">
            <img alt="Photo 3" data-src="holder.js/1140x500/auto/#555:#333/text:Third slide" src="3.jpg" data-holder-rendered="true" />
        </div>
    </div>
    <a data-slide="prev" role="button" href="#carousel" class="left carousel-control">
        <span aria-hidden="true" class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a data-slide="next" role="button" href="#carousel" class="right carousel-control">
        <span aria-hidden="true" class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<i>Some pictures of the beautiful BYUI campus</i>

<div class="page-header">
    <h1>About me</h1>
</div>
<h2 class="center"><span class="label label-info">Ricardo Goncalves</span></h2>
<p class="center">
    <img class="img-thumbnail" src="photo.jpg" /><br />
</p>
<h4 class="center">
    <span>I am from Sao Paulo Brazil.<br />
        My major is Computer Science<br />
        I love to be here at BYUI
    </span>
</h4>
<p class="center">
    <img class="img-thumbnail" src="flag.jpg" /><br />
</p>

<h4 class="center">
    <span>My first language is Portuguese</span>
</h4>

<div class="page-header">
    <h1>Courses</h1>
</div>
<p>
    Here are the classes I am taking this semester
</p>
<div class="row">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Course</th>
                <th>Section</th>
                <th>Title</th>
                <th>Meets</th>
                <th>Instructor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>CS 237</td>
                <td>01</td>
                <td>Discrete Mathematics I</td>
                <td>MWF -10:15 - 11:15 AM</td>
                <td>Neff, Richard Madsen</td>
            </tr>
            <tr>
                <td>CS 308</td>
                <td>02</td>
                <td>Technical Communication</td>
                <td>T -9:00 - 10:00 AM<br />
                    MWF -9:00 - 10:00 AM
                </td>
                <td>Twitchell, Kevin E.</td>
            </tr>
            <tr>
                <td>CS 313</td>
                <td>02</td>
                <td>Web Engineering II</td>
                <td>MW -3:15 - 4:45 PM</td>
                <td>Burton, Scott H.</td>
            </tr>
            <tr>
                <td>FDREL 200</td>
                <td>15</td>
                <td>Family Foundations</td>
                <td>MW -2:00 - 3:00 PM</td>
                <td>Bolingbroke, Michael K.</td>
            </tr>
            <tr>
                <td>FDWLD 101</td>
                <td>02</td>
                <td>World Foundations I</td>
                <td>Online</td>
                <td>Koon, Emily F.</td>
            </tr>
            <tr>
                <td>GS 100</td>
                <td>09</td>
                <td>Career Exploration</td>
                <td>MW -12:45 - 1:45 PM</td>
                <td>Robbins, Susanne M.</td>
            </tr>

        </tbody>
    </table>
</div>

<div class="page-header">
    <h1>Favorite Quote</h1>
</div>
<div role="alert" class="alert alert-info">
    <strong>"No other success can compensate for failure in the home."</strong> <i>David O. McKay</i>
</div>
<div class="page-header">
</div>

<?php include "footer.php" ?>
