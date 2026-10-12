@extends('layouts.website')
@section('content')
    <!-- News Detail Content -->
    <section class="news-detail-section">
        <div class="container">
            <!-- Breadcrumbs -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb news-detail-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('news') }}">History</a></li>
                </ol>
            </nav>

            {{-- <span class="news-detail-tag">{{ strtoupper($news->type) }}</span> --}}
            <h1 class="news-detail-title mb-5">History of Governor House Khyber Pakhtunkhwa</h1>


            <!-- Featured Image -->
            <div class="news-detail-img-container">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('front_assets/imgs/slide-1.jpg') }}" alt="house" class="news-detail-img">
                    </div>
                    <div class="col-md-6">
                        <h2>The Governor House, Peshawar</h2>
                        <p>Governor’s House, Peshawar, is a historic building constructed by the British. It stands to the
                            Peshawar museum and serves as the official residence of the Governor of Khyber Pakhtunkhwa.</p>
                        <p>Huge and gigantic, a symbol of authority and strength, Governor’s Houses all over in Pakistan are
                            representative of a federation. During the British Raj big houses and residencies were built for
                            the British officials in order to instill in the minds of the people, their power and authority,
                            and also to keep the British aloof and alienated from the natives.</p>
                        <p>These government residences were a complete estate in themselves. They had their unique
                            traditions and a distinction which divorced the people of the mansion, from the people of the
                            rest of the region. Dignitaries from all over the world were received with fanfare and
                            solemnity. In return the honourable guests would also come with gifts that still adorn the walls
                            of the Governor’s House.</p>
                    </div>
                </div>
            </div>

            <div class="news-detail-img-container">
                <div class="row">
                    <div class="col-md-6">
                        <p>The Governor’s residence is more than just a house. It has been witness to the history Governor
                            Houseof the region. Apart from the recorded history there is much that is only reflected in the
                            anecdotes and folklore within the Governor’s House amongst the small community of officers and
                            officials who served the government.</p>
                        <p>As the incumbents kept changing they brought their own tastes and character to the building and
                            the décor. The traces of the incumbents reflect their way of life and preferences.</p>
                        <p>The marks they left were not always consistent with the original architect and design. While some
                            adorned the place others marred some of the original beauty. The area now comprising Khyber
                            Pakhtunkhwa were part of the larger country under the Sikh reign that crumble under the British
                            invasion in 1849 giving way to the rule of East India Company. During the Sikh times, Peshawar
                            and the adjoining territories were presided over by a Governor appointed by the Maharaja.</p>
                        <p>The British realized the strategic importance of the location and hence, embarked upon developing
                            a cantonment in Peshawar, a large garrison would serve them as an anchor for their former
                            battles in the region and their wars against the Afghans. The forts and watch towers abandoned
                            by the earlier rulers were used where ever they could be Peshawar was soon teeming with British
                            soldiers. The British cantonment left an indelible mark on the culture and ambience of the city.
                        </p>

                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('front_assets/imgs/slide-2.jpg') }}" alt="house" class="news-detail-img">
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="news-detail-content">
                <p>The first British cantonment was four kilometers to the south west of the walled city of Peshawar in
                    1849. Amidst the gardens and orchids, away from the din of the city. It was the perfect place for them.
                    Most buildings, constructed during the period, were lost in the mist of time yet a few still survived.
                    One of them is the Deputy Commissioners residence which dates back to the early 1850’s. It became to be
                    known as the Governor’s House Peshawar after the North West Frontier was declared a separate province
                    under the Raj with Peshawar as its headquarter.</p>
                <p>“Situated on a low hillock that most likely conceals the remains of an ancient township, the building is
                    a clean break from the traditional fortified residence of tribal elders just outside the cantonment
                    limits. For visiting Pathans dignitaries, the exposed veranda and the absence of crenellations or
                    loopholes along the parapet or the well-placed defensive tower would have been either madness or some
                    hidden strength they failed to recognize. Howsoever they looked at it, the house remained unchanged
                    through those uncertain years.”</p>
                <p>As the town became the divisional headquarter the building became the Commissioner house where Colonel
                    Herbert Edwards stayed from 1853-58. The Welsh colonel worked hard to convert the city into an
                    impregnable center of British military might. During difficult time when the Indians were struggling
                    against the British Raj, “Edward and his deputy Commissioner John Nicholson share the roof before he
                    marched out in May 1857 to play his part in quelling the trouble.”</p>
                <p>“With the end of the bloody events of that fateful year, the East India Company ceded control of the
                    subcontinent to the British government and the house on the hill in Peshawar cantonment became the
                    official residence of the deputy commissioner. In 1880, the building underwent some renovation and
                    reconstruction work. It can be assume that the pediment that crowns the front and the pillared portico
                    were both added at this time. That is how the earliest known photograph dating to the 1920s shows the
                    house.” Herbert Edwards “entered the East India Company service in Bengal as an infantry cadet in 1841.
                    He utilized his extraordinary intelligence of a debater, writer and a poem composer, at King’s College
                    London with a frantic labour to pick up local languages. Hindustani (Urdu), Hindi and Persian, and thus
                    received quick attention from his immediate seniors for devotion to his work. 1853 found him placed
                    under the Peshawar Commissionerate.</p>
                <p>Edwards remained the Commissioner of Peshawar till 1859 and for his meritorious services to his nation he
                    was knighted, raised in a military rank (major general) and served elsewhere in India, till he retire in
                    1865 and returned home. He did not live very long and died in 1868 as a vice president to the Church
                    Missionary Society of England.” It was in the year 1902 when a part of Punjab, i.e. the west of the
                    Indus River was made the north West Frontier Province, and the Commissioners residence was converted
                    into the Governor’s House.</p>
                <p>The plan to consider a Government House at Peshawar was initiated soon after the formal inauguration of
                    the North West Frontier in April 1902. The NWFP came into being on H.M. The King’s birthday on November
                    9, 1901. The formal inauguration however, took place on April 26, 1902. When the Viceroy, Lort Curzaon
                    held a grand darbar at the Shahi Bagh, Peshawar, to which thousands of dignitaries from all over the
                    Province were invited.</p>
                <p>Writing to the Secretary to the Government of India, Public Works Department on June 21, 1902 the
                    Honourable Agent to the Governor-General and Chief Commissioner Peshawar in a dispatch said: “when in
                    1901 it was decided to form a separate administration for the officer of the Punjab Public Works
                    Department was deputed to put himself in communicating with Lieutenant Colonel Dean, to consider the
                    suitability or otherwise of the existing Commissioner’s house at Peshawar. A plan of that house was
                    accordingly sent to Lieutenant Colonel Deane who gave us his opinion that although some of the
                    arrangements in the hose were unobjectionable and might be retained yet the house would require
                    extensive alternations to make it wholly suitable.</p>
                <p>On this basis a plan and estimate, amounting to some of Rs. 43,000 was submitted to the Government of
                    India and sanctioned. This plan provided for the retention of part of the south-west portion of the old
                    building to the north and east. Before work, however, was commenced His Excellency the Viceroy, (Lord
                    Curzon) visited Peshawar, and after seeing the plans, His Excellency expressed the opinion that the
                    proposed would be inadequate to the purpose. The entire removal of the existing building and a design of
                    new one on the same site was the only alternative.”</p>
                <p>A new plan with estimate of expenditure amounting to Rs. 85,619 was submitted to the Secretary, PWD. It
                    was clarified that the only material locally available was brick and that also of a colourless quality.
                    It was suggested that the roof should be of a flat design which was popular in Peshawar. The interior
                    was to befit the prestige of a “Government House” with skirting, dados, boxed jambs & window stills,
                    papered rooms, artistic fire place, fixed baths, hot & cold water pipes, and other appurtenances of a
                    “civilized life”. In the new design the Durbar Hall was given special attention. It was proposed to
                    construct in on the general lines of an old “English Hall” with hammer beam roof, paneled ceiling and
                    walls up to about 12” from floor. A “Minstrel gallery” of Nowshera marble, surmounted by a curved
                    shisham wood screen on which the Coats of Arms of successive Chief Commissioners were to be hung, was to
                    be erected at the farthest end of the Hall. The main hall was to have stained glass windows with
                    mullions. A special corner was to be reserved for hanging portraits of distinguished persons. Trophies
                    of Arms were to be displayed at the other end of the room opposite the minstrel gallery. The whole
                    edifice was to be patterned after the Great Hall at Lought (Wilts) in England. As the modified design
                    was more elaborate, the cost was enhanced to Rs. 92,238. The Construction of the Government House was
                    completed in October 1903. The occasion was celebrated by holding a grand ball and reception.</p>
                <p>Alongwith the construction of the house, question of its furnished was also taken up with the authorities
                    in New Delhi. In May 1903, Lt.Col. G.K Scot Moncrieff, Secretary to the Chief Commissioner, Peshawar
                    submitted an estimate of Rs. 41,039 for the purchase of furniture. Of this amount, Rs. 34,000 were to be
                    spent on the furnishing of the reception room and the remaining for the private rooms of the Chief
                    Commissioner.</p>
                <p>Later in the budget for 1904-05, a sum of Rs. 2,491 was provided for the construction of a new “main
                    entrance gate” to the government house. In the next year’s budget a sum of Rs. 28,900 was provided for
                    electric light installations. This sum was repeated in the next year’s budget. Alterations and additions
                    to some portion of the house, particularly the guest house and bathrooms were made during 1911-12. The
                    paneling of the dining room was also completed during that year. The front verandah was further widened
                    in order to effectively screen off the sun. The annual administration report of the NWFP for 1911-12
                    state with satisfaction that remodeling of some portions and the whitewashing etc, had materially
                    improved the looks of the House which was “more suited” to the dignity and requirements of the Chief
                    Commissioner.</p>
            </div>


        </div>
    </section>
@endsection
