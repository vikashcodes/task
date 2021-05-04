<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>GitHub Api</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>

</head>

<body class="bg-gray-800 font-sans leading-normal tracking-normal mt-12">
  <!--Nav-->
  <nav class="bg-gray-800 pt-2 md:pt-1 pb-1 px-1 mt-0 h-auto fixed w-full z-20 top-0">
    <div class="flex flex-wrap items-center">
      <div class="flex flex-shrink md:w-1/3 justify-center md:justify-start text-white">
        <a href="{{route('welcome')}}">
          <span class="text-xl pl-2"><i class="em em-grinning">Github Api</i></span>
        </a>
      </div>

      <div class="flex flex-1 md:w-1/3 justify-center md:justify-start text-white px-2">
        <span class="relative w-full">
          <form action="{{route('get.repos')}}" method="post">
            @csrf
            <input type="search" name="searchtext" id="searchbar" placeholder="Search Here for the GitHub Repos" class="w-full bg-gray-900 text-white transition border border-transparent focus:outline-none focus:border-gray-400 rounded py-3 px-2 pl-10 appearance-none leading-normal" />
          </form>
          <div class="absolute search-icon" style="top: 1rem; left: .8rem;">
            <svg class="fill-current pointer-events-none text-white w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
              <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
            </svg>
          </div>
        </span>
      </div>
    </div>
  </nav>
  <br>


  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Repo Name
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Owner
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Avatar
                </th>
                <th scope="col" class="px-1 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Description
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Stars
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Forks
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  View Repo
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @if(isset($result))
              @if($result['total_count']==0)
              <tr>
                  <td colspan="7" class="w-full py-3  whitespace-wrap text-center text-red-500 text-l text-gray-500">
                    No such repositories are available by the name. Please search any other name.
                  </td>
              </tr>
              @else
                @foreach($result['items'] as $data)
                <tr>
                  <td class="px-6 py-2 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="text-sm text-gray-900">{{$data['name']}}</div>

                    </div>
                  </td>
                  <td class="px-6 py-2 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold">
                    {{$data['owner']['login']}}
                    </span>

                  </td>
                  <td class="px-6 py-2 whitespace-nowrap">
                    <div class="flex-shrink-0 h-10 w-10">
                      <img class="h-10 w-10 rounded-full" src="{{$data['owner']['avatar_url']}}" alt="">
                    </div>
                  </td>
                  <td class="px-2 py-2 whitespace-wrap justify-left text-sm text-gray-500">
                    {{$data['description']}}
                  </td>
                  <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500">
                    {{$data['stargazers_count']}}
                  </td>
                  <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500">
                    {{$data['forks_count']}}
                  </td>
                  <td class=" whitespace-nowrap text-center text-sm font-medium">
                    <a href="{{($data['html_url'])}}" class="w-3/4 flex items-center justify-center text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-2 md:text-sm md:px-5">
                      View
                    </a>
                  </td>
                </tr>
                @endforeach
                @endif
              @endif

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</body>

</html>