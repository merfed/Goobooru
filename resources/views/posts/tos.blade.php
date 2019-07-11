@extends('layouts.no-sidebar')

@section('mini-nav')
@include('partials.mini-nav.posts')
@endsection

@section('content')
<div class="container-sm">
    <h1 style="margin: 0 0 30px 0;">Terms of Service</h1>

    <p>By accessing the Goobooru website ("Site") you accept the following Terms of Service. From that point onwards, Goobooru will treat your use of the Site as acceptance of the Terms.</p>

    <ul style="padding-left: 40px;">
        <li>The Site reserves the right to change these terms at any time.</li>
        <li>If you are a minor, then you will not use the Site.</li>
        <li>The Site is presented to you AS IS, without any warranty, express or implied. You will not hold the Site or its staff members liable for damages caused by the use of the site.</li>
        <li>The Site reserves the right to delete or modify your account, or any content you have posted to the site.</li>
        <li>You will upload content that is of high quality.</li>
        <li>You agree to not block, hide, assist others in, or circumvent the displaying of advertisements on the site. <i>This is a <b>free</b> archive site, and you are not helping it remain so</i>.</li>
        <li>You understand that there may be content on the Site that does not appeal to you or you feel is morally wrong.</li>
        <li>You accept that the Site is not liable for any content that you may stumble upon.</li>
        <li>You are using this site only for personal use.</li>
        <li>You will not use any automated process to retrieve or index any portion of the site or site contents, with the exception of public search engines.</li>
        <li>The operators of the site are not entirely held to these terms.</li>
    </ul>

    <h1 style="margin: 20px 0 30px 0;">Prohibited Content</h1>

    <p>In addition, you may not use the Site to upload any of the following:</p>

    <ul style="padding-left: 40px;">
        <li>Any photograph or photorealistic drawing or movie that depicts children in a sexual manner. This includes nudity, explicit sex, implied sex, or sexually persuasive positions.</li>
        <li>Any photograph or photorealistic drawing or movie that depicts humans having sex (either explicit or implied) with other non-human animals.</li>
        <li>Any image where a person who is not the original copyright owner has placed a watermark on the image.</li>
        <li>Screen captures are not allowed unless given exception due to work in compiling said screen shot.</li>
        <li>Any image where compression artifacts are easily visible.</li>
        <li>Any depiction of extreme mutilation, extreme bodily distension, feces.</li>
        <li>Paysites: This should be plainly obvious, but apparently it needs to be listed here.</li>
    </ul>

    <p>Operators and site staff <i>are</i> held to these terms.</p>

    <h1 style="margin: 20px 0 30px 0;">Privacy Policy</h1>

    <p>The Site will not disclose the IP address or email address of any user except to the staff.</p>

    <p>We use cookies to store your settings you configure on the site.</p>

    <p>The Site is allowed to make public everything else, including but not limited to: uploaded posts, favorited posts, comments, forum posts, and any edits made to the site.</p>
</div>
@endsection
