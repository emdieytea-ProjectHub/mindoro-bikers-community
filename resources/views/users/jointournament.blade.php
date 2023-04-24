@extends('users.layout.app')

@section('head-scripts')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
@endsection

@section('body')
        <div class="central-meta" style="border: 3px solid #0af5dd; border-radius:5px;  box-shadow: 10px 10px aquamarine; ">
            <h1>
                <small>Join Tournament</small> - {{ $tournament->name }}
            </h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @foreach ($tournament_group_join as $tg)
                @if ($tg->user_id == Auth::id())
                    <strong class="text-success h2">{{ 'You already joined!' }}</strong>
                @endif
            @endforeach

            <form method="post" action="{{ route('join_tournament_now') }}" novalidate>
                @csrf
                <input type="text" name="tournamentId" value="{{ $tournament->id }}" hidden required>
                @if ($tournament_group->count() >= 1)
                    <div class="form-group" id="group_id">
                        <select name="groupId" onchange="javascript:catHasChangeHandler(this)" required>
                            <option value="">Select your desire group for tournament</option>
                            @foreach ($tournament_group as $group)
                                <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="form-group" id="group_name">
                    <input type="text" name="groupName" onkeyup="javascript:hasValueHandler(this)" required>
                    <label class="control-label" for="input">Create your own group for tournament</label>
                    <i class="mtrl-select"></i>
                </div>

                <div class="form-group">
                    <input type="number" name="age" required="required">
                    <label class="control-label" for="input">Enter your age</label><i class="mtrl-select"></i>
                </div>

                <div class="form-group">
                    <textarea name="location" required></textarea>
                    <label class="control-label" for="textarea">Enter your address</label><i class="mtrl-select"></i>
                </div>

                <div class="submit-btns">
                    <button type="submit" class="mtr-btn pull-right">
                        <span>Join now</span>
                    </button>
                </div>
            </form>
        </div>
@endsection

@push('custom-scripts')
    <script type="text/javascript">
        let group_name = document.getElementById('group_name')

        const hasValueHandler = (evt) => {

            let select_group = document.getElementById('group_id')

            if (evt.value.length >= 1) {
                select_group.style.display = 'none'
            } else {
                select_group.style.display = 'block'
            }
        }

        const catHasChangeHandler = (evt) => {
            if (evt.value.length >= 1) {
                group_name.style.display = 'none'
            } else {
                group_name.style.display = 'block'
            }
        }
    </script>
@endpush
