@extends('Layouts_new.index')

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('store.index') }}">Daftar Store</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Informasi Store</li>
        </ol>
    </nav>
@endsection

@section('content')
    <section id="edit-information">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Informasi Store</h4>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-light-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('store.update-information', $dataStore->uuid) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nama Store</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $dataStore->name }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="description" name="description" rows="3">{{ $dataStore->description }}</textarea>
                                </div>

                                <!-- Updated address field -->
                                <div class="col-md-6 mb-3">
                                    <label for="address" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="{{ $dataStore->address }}" readonly>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Telepon</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ $dataStore->phone }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $dataStore->email }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="opening_time" class="form-label">Jam Buka</label>
                                    <input type="time" class="form-control" id="opening_time" name="opening_time"
                                        value="{{ $dataStore->opening_time }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="closing_time" class="form-label">Jam Tutup</label>
                                    <input type="time" class="form-control" id="closing_time" name="closing_time"
                                        value="{{ $dataStore->closing_time }}">
                                </div>

                                <!-- Longitude and Latitude fields -->
                                <div class="col-md-6 mb-3">
                                    <label for="longitude" class="form-label">Longitude</label>
                                    <input type="text" class="form-control" id="longitude" name="longitude"
                                        value="{{ $dataStore->longitude }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="latitude" class="form-label">Latitude</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude"
                                        value="{{ $dataStore->latitude }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="map" class="form-label">Pilih Lokasi</label>
                                    <div id="map" style="height: 400px;"></div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('store.index') }}" class="btn btn-secondary me-2">Batal</a>
                                <button type="submit" class="btn btn-success">Update Informasi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Leaflet and Nominatim for geocoding -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Initial latitude and longitude
        var latitude = {{ $dataStore->latitude ?? -6.2 }};
        var longitude = {{ $dataStore->longitude ?? 106.816666 }};

        // Initialize the map
        var map = L.map('map').setView([latitude, longitude], 13);

        // Add the tile layer from OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        // Add a draggable marker to the map
        var marker = L.marker([latitude, longitude], {
            draggable: true
        }).addTo(map);

        // Geocoding function using Nominatim API (with Bahasa Indonesia)
        function getAddress(lat, lng) {
            var url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}&accept-language=id`;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data && data.address) {
                        var address = data.display_name;
                        document.getElementById('address').value = address;
                    } else {
                        document.getElementById('address').value = 'Alamat tidak ditemukan';
                    }
                })
                .catch(error => {
                    console.error('Error fetching address:', error);
                    document.getElementById('address').value = 'Error fetching address';
                });
        }

        // Update input fields when marker is dragged
        marker.on('dragend', function(e) {
            var position = marker.getLatLng();
            document.getElementById('latitude').value = position.lat;
            document.getElementById('longitude').value = position.lng;
            getAddress(position.lat, position.lng); // Update the address based on new coordinates
        });

        // Update marker position when input values change
        document.getElementById('latitude').addEventListener('change', function() {
            var lat = this.value;
            var lng = document.getElementById('longitude').value;
            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], 13);
            getAddress(lat, lng); // Update the address
        });
        document.getElementById('longitude').addEventListener('change', function() {
            var lat = document.getElementById('latitude').value;
            var lng = this.value;
            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], 13);
            getAddress(lat, lng); // Update the address
        });

        // Initial fetch of address based on current coordinates
        getAddress(latitude, longitude);
    </script>
@endsection
