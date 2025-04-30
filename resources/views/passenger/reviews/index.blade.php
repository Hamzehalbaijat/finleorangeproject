@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Reviews for {{ $bus->name }}</h4>
                        <a href="{{ route('passenger.buses.show', $bus) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Bus
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if($reviews->isEmpty())
                        <div class="alert alert-info">
                            No reviews yet for this bus.
                        </div>
                    @else
                        <div class="list-group">
                            @foreach($reviews as $review)
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="mb-1">{{ $review->user->name }}</h5>
                                            <div class="mb-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star{{ $i <= $review->rating ? ' text-warning' : ' text-secondary' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                    </div>
                                    
                                    @if($review->comment)
                                        <p class="mb-1">{{ $review->comment }}</p>
                                    @endif
                                    
                                    @can('delete', $review)
                                        <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-3">
                            {{ $reviews->links() }}
                        </div>
                    @endif
                </div>
                
                @if(auth()->check() && !$reviews->where('user_id', auth()->id())->count())
                    <div class="card-footer text-center">
                        <a href="{{ route('passenger.reviews.create', $bus) }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Your Review
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection