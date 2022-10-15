<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <h2>Tables reservation:</h2>
            <form wire:submit.prevent="submit" method="POST">
                @csrf
                @method('POST')
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" class="form-control" aria-describedby="name" wire:model="name">
                    @error('name') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="surname" class="form-label">Surname:</label>
                    <input type="text" name="surname" class="form-control" aria-describedby="surname" wire:model="surname">
                    @error('surname') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone:</label>
                    <input type="text" name="phone" class="form-control" aria-describedby="phone" wire:model="phone">
                    @error('phone') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="duration" class="form-control" aria-describedby="email" wire:model="email">
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="restaurant" class="form-label">Restaurant:</label>
                    <select name="restaurant" wire:model="restaurant" class="form-select" aria-label="Select restaurant">
                        <option value=''>Select a restaurant</option>
                        @foreach ($restaurants as $restaurant)
                            <option value="{{ $restaurant->id }}">
                                {{ $restaurant->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('restaurant') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Reservation date:</label>
                    <input type="date" name="date" class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                           aria-describedby="date" wire:model="date">
                    @error('date') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="time" class="form-label">Reservation time:</label>
                    <input type="time" name="time" class="form-control" aria-describedby="time" wire:model="time">
                    @error('time') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="duration" class="form-label">Duration (hours):</label>
                    <input type="number" name="duration" class="form-control" aria-describedby="duration" wire:model="duration">
                    @error('duration') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-3">
                            <button class="btn btn-primary mb-3" wire:click.prevent="add({{$index}})">Add client</button>
                        </div>
                        @foreach ($inputs as $key => $value)
                            <div class="input-group">
                                <div class="col-3">
                                    <label class="visually-hidden">Name</label>
                                    <input type="text" class="form-control" placeholder="Name" wire:model="clients.{{ $value }}.name">
                                    @error('clients.'.$value.'.name') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-3">
                                    <label class="visually-hidden">Surname</label>
                                    <input type="text" class="form-control" placeholder="Surname" wire:model="clients.{{ $value }}.surname">
                                    @error('clients.'.$value.'.surname') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-3">
                                    <label class="visually-hidden">Email</label>
                                    <input type="text" class="form-control" placeholder="Email" wire:model="clients.{{ $value }}.email">
                                    @error('clients.'.$value.'.email') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-danger mb-3" wire:click.prevent="remove({{$key}})">Remove</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @if($notification)
                <div class="mb-3">
                    <div class="alert alert-danger" role="alert">
                        {{ $notification }}
                    </div>
                </div>
                @endif
                @error('clients') <span class="error">{{ $message }}</span> @enderror
                <div class="mb-3">
                    <button type="submit" class="btn btn-success mt-2">Make reservation</button>
                </div>
            </form>
        </div>
    </div>
</div>
