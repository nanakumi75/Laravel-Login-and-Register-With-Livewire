<!DOCTYPE html>
<html lang="en">
<head>
   <x-header-component/>
</head>
<body>
    <x-navigation-component/>
     <div class="container-fluid p-3 my-5">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center text-success">Trial Technology Questions From An External API</h4>
                <table class="table table-striped table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>Questions</th>
                            <th>Answer A</th>
                            <th>Answer B</th>
                            <th>Answer C</th>
                            <th>Answer D</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($questions as $question)
                            <tr>
                                <td>{{ $question->question }}</td>
                                <td>{{ $question->answers->answer_a }}</td>
                                <td>{{ $question->answers->answer_b }}</td>
                                <td>{{ $question->answers->answer_c }}</td>
                                <td>{{ $question->answers->answer_d }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
     </div>
    <x-footer-component/>
</body>
</html>
