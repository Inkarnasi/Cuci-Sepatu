@extends('Layouts_new.index')

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('store.index') }}">Daftar Store</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Media Sosial</li>
        </ol>
    </nav>
@endsection

@section('content')
    <section id="edit-social-media">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Media Sosial Store</h4>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-light-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('store.update-social-media', $dataStore->uuid) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="facebook_url" class="form-label">Facebook URL</label>
                                <input type="url" class="form-control" id="facebook_url" name="facebook_url"
                                    value="{{ $dataStore->facebook_url }}"
                                    placeholder="https://facebook.com/store">
                            </div>

                            <div class="mb-3">
                                <label for="instagram_url" class="form-label">Instagram URL</label>
                                <input type="url" class="form-control" id="instagram_url" name="instagram_url"
                                    value="{{ $dataStore->instagram_url }}"
                                    placeholder="https://instagram.com/store">
                            </div>

                            <div class="mb-3">
                                <label for="twitter_url" class="form-label">Twitter URL</label>
                                <input type="url" class="form-control" id="twitter_url" name="twitter_url"
                                    value="{{ $dataStore->twitter_url }}"
                                    placeholder="https://twitter.com/store">
                            </div>

                            <div class="mb-3">
                                <label for="tiktok_url" class="form-label">Tiktok URL</label>
                                <input type="url" class="form-control" id="tiktok_url" name="tiktok_url"
                                    value="{{ $dataStore->tiktok_url }}"
                                    placeholder="https://tiktok.com/@store">
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('store.index') }}" class="btn btn-secondary me-2">Batal</a>
                                <button type="submit" class="btn btn-success">Update Media Sosial</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
