<div class="container-fluid bg-light-gray">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="col">
                <img src="{{ asset('images/themes/dog.gif') }}" class="college-dog" onclick="showModal('programsList')" alt="College Dog" />
            </div>
            <div class="col-md-9">
                <div class="row align-items-center">
                    <div class="col-lg-5 py-1">
                        <span class="contact text-red" style="--icon: '\f3e8'" data-language="{{ $language }}">{{ __('static.contact.address') }}</span>
                    </div>
                    <div class="col-lg-3 text-center py-1">
                        <a class="contact text-red" href="tel:0322140314" style="--icon: '\f5c1'">
                            <span data-language="{{ $language }}">(032) 2-140-314</span>
                        </a>
                    </div>
                    <div class="col-lg-4 py-1">
                        <a class="contact text-red" href="mailto:polrofgldaniedu@gmail.com" style="--icon: '\f32f'">
                            <span data-language="{{ $language }}">profgldaniedu@gmail.com</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-center">
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <!-- Facebook -->
                    <a
                    type="button"
                    class="btn social-icon"
                    target="_blank"
                    href="https://www.facebook.com/profile.php?id=100063588697917"
                    aria-label="Visit our Facebook page (opens in new window)"
                    >
                    <svg
                        fill="#b7312e"
                        width="16"
                        height="16"
                        viewBox="0 0 64 64"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M47.4008 25.8H41.8008H39.8008V23.8V17.6V15.6H41.8008H46.0008C47.1008 15.6 48.0008 14.8 48.0008 13.6V3C48.0008 1.9 47.2008 1 46.0008 1H38.7008C30.8008 1 25.3008 6.6 25.3008 14.9V23.6V25.6H23.3008H16.5008C15.1008 25.6 13.8008 26.7 13.8008 28.3V35.5C13.8008 36.9 14.9008 38.2 16.5008 38.2H23.1008H25.1008V40.2V60.3C25.1008 61.7 26.2008 63 27.8008 63H37.2008C37.8008 63 38.3008 62.7 38.7008 62.3C39.1008 61.9 39.4008 61.2 39.4008 60.6V40.3V38.3H41.5008H46.0008C47.3008 38.3 48.3008 37.5 48.5008 36.3V36.2V36.1L49.9008 29.2C50.0008 28.5 49.9008 27.7 49.3008 26.9C49.1008 26.4 48.2008 25.9 47.4008 25.8Z"
                        />
                    </svg>
                    </a>
                    <!-- YouTube -->
                    <a
                    type="button"
                    class="btn social-icon"
                    target="_blank"
                    href="https://www.youtube.com/@გლდანისპროფესიულიმომზადებისცენ"
                    aria-label="Visit our YouTube channel (opens in new window)"
                    >
                    <svg
                        fill="#b7312e"
                        width="16"
                        height="16"
                        viewBox="0 0 64 64"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M61.7 17.0998C61 14.3998 58.9 12.2998 56.2 11.5998C51.4 10.2998 32 10.2998 32 10.2998C32 10.2998 12.6 10.2998 7.8 11.5998C5.1 12.2998 3 14.3998 2.3 17.0998C1 21.9998 1 31.9998 1 31.9998C1 31.9998 1 42.0998 2.3 46.8998C3 49.5998 5.1 51.6998 7.8 52.3998C12.6 53.6998 32 53.6998 32 53.6998C32 53.6998 51.4 53.6998 56.2 52.3998C58.9 51.6998 61 49.5998 61.7 46.8998C63 42.0998 63 31.9998 63 31.9998C63 31.9998 63 21.9998 61.7 17.0998ZM25.8 41.2998V22.6998L41.9 31.9998L25.8 41.2998Z"
                        />
                    </svg>
                    </a>
                    <!-- TikTok -->
                    <a
                    type="button"
                    class="btn social-icon"
                    target="_blank"
                    href="https://www.tiktok.com/@profgldani"
                    aria-label="Visit our TikTok profile (opens in new window)"
                    >
                    <svg
                        fill="#b7312e"
                        width="16"
                        height="16"
                        viewBox="0 0 64 64"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <g clip-path="url(#clip0_412_113)">
                            <path
                                d="M33.4133 0.0533333C36.9067 0 40.3733 0.0266667 43.84 0C44.0533 4.08 45.52 8.24 48.5067 11.12C51.4933 14.08 55.7067 15.44 59.8133 15.8933V26.64C55.9733 26.5067 52.1067 25.7067 48.6133 24.0533C47.0933 23.36 45.68 22.48 44.2933 21.5733C44.2667 29.36 44.32 37.1467 44.24 44.9067C44.0267 48.64 42.8 52.3467 40.64 55.4133C37.1467 60.5333 31.0933 63.8667 24.88 63.9733C21.0667 64.1867 17.2533 63.1467 14 61.2267C8.61334 58.0533 4.82668 52.24 4.26668 46C4.21334 44.6667 4.18668 43.3333 4.24001 42.0267C4.72001 36.96 7.22668 32.1067 11.12 28.8C15.5467 24.96 21.7333 23.12 27.52 24.2133C27.5733 28.16 27.4133 32.1067 27.4133 36.0533C24.7733 35.2 21.68 35.44 19.36 37.04C17.68 38.1333 16.4 39.8133 15.7333 41.7067C15.1733 43.0667 15.3333 44.56 15.36 46C16 50.3733 20.2133 54.0533 24.6933 53.6533C27.68 53.6267 30.5333 51.8933 32.08 49.36C32.5867 48.48 33.1467 47.5733 33.1733 46.5333C33.44 41.76 33.3333 37.0133 33.36 32.24C33.3867 21.4933 33.3333 10.7733 33.4133 0.0533333Z"
                            />
                        </g>
                        <defs>
                            <clipPath id="clip0_412_113">
                                <rect width="64" height="64" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                    </a>
                    <!-- Instagram -->
                    <a
                    type="button"
                    class="btn social-icon"
                    target="_blank"
                    href="https://www.instagram.com/profgldani/?fbclid=IwZXh0bgNhZW0CMTAAAR0JJVBC4gvybv8uyqVSacqM3Et60Dl995xLfNQRoJQQPVPde2fTGr38_BM_aem_KBZj5jLYTGnoziz440tJtg"
                    aria-label="Visit our Instagram profile (opens in new window)"
                    >
                    <svg
                        fill="#b7312e"
                        width="16"
                        height="16"
                        viewBox="0 0 64 64"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M32.1 43.6004C38.5065 43.6004 43.7 38.4069 43.7 32.0004C43.7 25.5939 38.5065 20.4004 32.1 20.4004C25.6935 20.4004 20.5 25.5939 20.5 32.0004C20.5 38.4069 25.6935 43.6004 32.1 43.6004Z"
                        />
                        <path
                            d="M44.7 1H19.3C9.2 1 1 9.2 1 19.3V44.5C1 54.8 9.2 63 19.3 63H44.5C54.8 63 63 54.8 63 44.7V19.3C63 9.2 54.8 1 44.7 1ZM32.1 47.2C23.6 47.2 16.9 40.3 16.9 32C16.9 23.7 23.7 16.8 32.1 16.8C40.4 16.8 47.2 23.7 47.2 32C47.2 40.3 40.5 47.2 32.1 47.2ZM53.1 18.2C52.1 19.3 50.6 19.9 48.9 19.9C47.4 19.9 45.9 19.3 44.7 18.2C43.6 17.1 43 15.7 43 14C43 12.3 43.6 11 44.7 9.8C45.8 8.6 47.2 8 48.9 8C50.4 8 52 8.6 53.1 9.7C54.1 11 54.8 12.5 54.8 14.1C54.7 15.7 54.1 17.1 53.1 18.2Z"
                        />
                        <path
                            d="M49.0016 11.5996C47.7016 11.5996 46.6016 12.6996 46.6016 13.9996C46.6016 15.2996 47.7016 16.3996 49.0016 16.3996C50.3016 16.3996 51.4016 15.2996 51.4016 13.9996C51.4016 12.6996 50.4016 11.5996 49.0016 11.5996Z"
                        />
                    </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
