<x-app-layout>
    <div class="container">
        <div class="col-6 mx-auto">
            <form action="{{ route('memo.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="3" placeholder="ここにメモを入力" required>{{ old('content') }}</textarea>
                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    重要度：
                    <div class="form-check form-check-inline @error('priority') is-invalid @enderror">
                        <input class="form-check-input" type="radio" name="priority" id="priority1" value="{{ \App\Models\Memo::PRIORITY_LOW }}" @if(old('priority') == \App\Models\Memo::PRIORITY_LOW) checked @endif>
                        <label class="form-check-label" for="priority1">★</label>
                    </div>
                    <div class="form-check form-check-inline @error('priority') is-invalid @enderror">
                        <input class="form-check-input" type="radio" name="priority" id="priority2" value="{{ \App\Models\Memo::PRIORITY_MIDDLE }}" @if(old('priority') == \App\Models\Memo::PRIORITY_LOW) checked @endif>
                        <label class="form-check-label" for="priority2">★★</label>
                    </div>
                    <div class="form-check form-check-inline @error('priority') is-invalid @enderror">
                        <input class="form-check-input" type="radio" name="priority" id="priority3" value="{{ \App\Models\Memo::PRIORITY_HIGH }}" @if(old('priority') == \App\Models\Memo::PRIORITY_LOW) checked @endif>
                        <label class="form-check-label" for="priority3">★★★</label>
                    </div>
                    @error('priority')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 row">
                    <label for="deadline" class="col-sm-2 col-form-label">期限：</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control @error('deadline') is-invalid @enderror" name="deadline" id="deadline" value="{{ old('deadline') }}">
                        @error('deadline')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="file" class="col-sm-2 col-form-label">画像：</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" id="file">
                        @error('file')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mb-3">作成</button>
                </div>
            </form>

            <hr>

            @if($memos->isNotEmpty())
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">メモ内容</th>
                            <th scope="col">画像</th>
                            <th scope="col" class="text-nowrap">重要度</th>
                            <th scope="col" class="text-nowrap">期限</th>
                            <th scope="col" class="text-nowrap">編集</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($memos as $memo)
                            <tr>
                                <td style="white-space: pre-wrap">{{ $memo->content }}</td>
                                <td>
                                    @if($memo->path)
                                        <img src="{{ asset('storage/' . $memo->path) }}" alt="" width="50" height="50">
                                    @endif
                                </td>
                                <td class="text-nowrap">{{ \App\Models\Memo::PRIORITIES[$memo->priority] }}</td>
                                <td class="text-nowrap">{{ $memo->deadline->format('Y/m/d') }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('memo.edit', $memo) }}" class="btn btn-primary">編集</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center">
                    メモはありません。
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
