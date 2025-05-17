@props(['newsletter'])
<div class="bb-popnews-bg fixed left-[0] top-[0] w-full h-full bg-[#00000080] hidden z-[25] hidden"></div>
<div class="bb-popnews-box w-full max-w-[600px] p-[24px] fixed left-[50%] top-[50%] bg-[#fff] hidden z-[25] text-center rounded-[15px] overflow-hidden max-[767px]:w-[90%]">
    <div class="bb-popnews-close transition-all duration-[0.3s] ease-in-out w-[16px] h-[20px] absolute top-[-5px] right-[27px] bg-[#e04e4eb3] rounded-[10px] cursor-pointer hover:bg-[#e04e4e]" title="Close"></div>
    <div class="flex flex-wrap mx-[-12px]">
        <div class="min-[768px]:w-[50%] w-full px-[12px]">
            <img src="https://i.pinimg.com/236x/7b/e6/cb/7be6cbdd184f4d965ac51110b6e3425a.jpg" alt="newsletter" class="w-full rounded-[15px] max-[767px]:hidden">
        </div>
        <div class="min-[768px]:w-[50%] w-full px-[12px]">
            <div class="bb-popnews-box-content h-full flex flex-col items-center justify-center">
                <h2 class="font-quicksand text-[#3d4750] block text-[22px] leading-[33px] font-semibold mt-[0] mx-[auto] mb-[10px] tracking-[0] capitalize">Newsletter</h2>
                <p class="font-Poppins font-light tracking-[0.03rem] mb-[8px] text-[14px] leading-[22px] text-[#686e7d]">{{ $newsletter->description }}</p>
                <form action="{{ route('newsletter.subscribe') }}" method="POST">
                    @csrf
                    <input type="hidden" name="newsletter_id" value="{{ $newsletter->id }}">

                    <input type="text" name="phone" placeholder="Phone Number" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <button type="submit" class="mt-3 p-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Subscribe</button>
                </form>



            </div>
        </div>
    </div>
</div>


{{--ma'lumotni  keyinchalik adminini doshbort qismi korsatib turishi kerk qaysi newsletterga qodirgani korib turadi shu --}}

