@extends('layouts.no-sidebar')

@section('mini-nav')
@include('partials.mini-nav.posts')
@endsection

@section('content')
<div class="container-sm">
    <h1 style="margin: 0 0 30px 0;">DMCA Removal Request Page</h1>

    <p>In order to process your complaint quickly, we will need you to fill out the following information. This information will be shared with 3rd parties for transparency purposes. If any information is invalid, omitted, or is a duplicate submission, the notice will be ignored and discarded.</p>

    <form>
        <dl class="form-group">
            <dt><label for="contact">Contact Information <em>(Full Name, Mailing Address, Phone Number, E-mail)</em></label></dt>
            <dd><textarea name="contact" id="" cols="30" rows="10" class="form-control"></textarea></dd>
        </dl>

        <dl class="form-group">
            <dt><label for="image">Image ID</label></dt>
            <dd><input type="text" class="input-block form-control" name="image"></dd>
        </dl>

        <dl class="form-group">
            <dt><label for="source">Original Content URL</label></dt>
            <dd><input type="text" class="input-block form-control" name="source"></dd>
        </dl>

        <div class="form-checkbox">
            <label>
                <input type="checkbox"> I swear, under penalty of perjury, that the information in the notification is accurate and that I am the copyright owner or am authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.
            </label>
        </div>

        <div class="form-checkbox">
            <label>
                <input type="checkbox"> I have good faith belief that the use of the copyrighted materials described above and contained on the service is not authorized by the copyright owner, its agent, or by protection of law.
            </label>
        </div>

        <dl class="form-group">
            <dt><label for="signature">Signature</label></dt>
            <dd><input type="text" class="input-block form-control" name="signature"></dd>
        </dl>

        <button class="btn" type="submit">Submit DMCA Notice</button>
    </form>


</div>
@endsection
