import React, { useEffect } from 'react';
import { Head, Link } from '@inertiajs/react';
import PublicLayout from '@/Layouts/PublicLayout';

const teachers = [
    { name: "Uyat Sudaryat, S.T., M.M.", title: "Kepala Sekolah", subject: "Kepala SMK Purnawarman Purwakarta", img: "/images/website/IMG-20240902-WA0040-rotated-e1752724979795-1024x1024.jpg" },
    { name: "Santi Tri Astuti, S.M.", title: "Waka Bidang Kurikulum", subject: "Guru Mapel Produktif ULP", img: "/images/website/IMG-20250702-WA0043-1024x1024.jpg" },
    { name: "Slamet Kuatno, S.Pd", title: "Waka Bidang Kesiswaan", subject: "Guru Mapel PJOK", img: "/images/website/Slamet-Kuatno-S.Pd_-e1752591548514.jpg" },
    { name: "Ferlina Effendy, S.E.", title: "Pengelola Keuangan", subject: "Guru Mapel Produktif PMS", img: "/images/website/momfer.jpg" },
    { name: "Rico Eriansyah, A.Md.T", title: "Kepala Laboratorium Komputer", subject: "Kepala Laboratorium Komputer & Guru Produktif PPLG", img: "/images/website/rico.png" },
    { name: "Ika Indriana Astuti, S.Kom", title: "Kepala Kompetensi Keahlian PPLG", subject: "Guru Mapel Produktif PPLG", img: "/images/website/Gambar-WhatsApp-2025-07-17-pukul-05.33.19_8cf74797-e1752723601829.jpg" },
    { name: "Tuti Choiriyah, S.E.", title: "Kepala Kompetensi Keahlian MPLB", subject: "Guru Mapel Produktif MPLB", img: "/images/website/Tuti-Choiriyah.jpg" },
    { name: "Jejen Nujaenah, S.Pd", title: "Kepala Kompetensi Keahlian AKL", subject: "Guru Mapel Produktif AKL", img: "/images/website/20230302_064233_C12F2AA1-1C29-4496-9C99-03A1DA62D057_Original-e1752630958194-1022x1024.jpg" },
    { name: "Crista Bella Cikitha, S.E.", title: "Kepala Kompetensi Keahlian Pemasaran", subject: "Guru Mapel Produktif Pemasaran", img: "/images/website/Gambar-WhatsApp-2025-07-16-pukul-09.05.46_58e7e85b-e1752631854756.jpg" },
    { name: "Tita Devita, S.Tr.Par.", title: "Kepala Kompetensi Keahlian ULP", subject: "Guru Mapel Produktif ULP", img: "/images/website/tita-devita.jpg" },
];

export default function Home() {
    useEffect(() => {
        function initTeacherSlider() {
            const sliderContainer = document.querySelector('.slider-container');
            if (!sliderContainer) return;

            const sliderWrapper = sliderContainer.querySelector('.slider-wrapper');
            const prevBtn = sliderContainer.querySelector('.prev-btn');
            const nextBtn = sliderContainer.querySelector('.next-btn');
            const slides = Array.from(sliderWrapper.children);
            if (slides.length === 0) return;

            let currentIndex = 0;
            let autoSlideInterval;

            const updateSlider = () => {
                const slideWidth = slides[0].clientWidth;
                sliderWrapper.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
            }

            const showNextSlide = () => {
                const slideWidth = slides[0].clientWidth;
                const slidesPerView = Math.round(sliderContainer.clientWidth / slideWidth);
                const maxIndex = slides.length - slidesPerView;

                currentIndex++;
                if (currentIndex > maxIndex) {
                    currentIndex = 0;
                }
                updateSlider();
            }

            const showPrevSlide = () => {
                const slideWidth = slides[0].clientWidth;
                const slidesPerView = Math.round(sliderContainer.clientWidth / slideWidth);
                const maxIndex = slides.length - slidesPerView;

                currentIndex--;
                if (currentIndex < 0) {
                    currentIndex = maxIndex > 0 ? maxIndex : 0; // Pastikan maxIndex > 0
                }
                updateSlider();
            }

            const startAutoSlide = () => {
                stopAutoSlide();
                autoSlideInterval = setInterval(showNextSlide, 5000);
            }

            const stopAutoSlide = () => clearInterval(autoSlideInterval);

            nextBtn.addEventListener('click', showNextSlide);
            prevBtn.addEventListener('click', showPrevSlide);
            window.addEventListener('resize', updateSlider);
            sliderContainer.addEventListener('mouseenter', stopAutoSlide);
            sliderContainer.addEventListener('mouseleave', startAutoSlide);

            updateSlider();
            startAutoSlide();

            // Cleanup function
            return () => {
                nextBtn.removeEventListener('click', showNextSlide);
                prevBtn.removeEventListener('click', showPrevSlide);
                window.removeEventListener('resize', updateSlider);
                sliderContainer.removeEventListener('mouseenter', stopAutoSlide);
                sliderContainer.removeEventListener('mouseleave', startAutoSlide);
                stopAutoSlide();
            };
        }
        initTeacherSlider();
    }, []);

    return (
        <>
            <Head title="Homepage - SMK Purnawarman" />
            <PublicLayout>
                <div className="homepage-wrapper">
                    <div id="page-home" data-path="home" source-type="Generator" data-doctype="Web Page" source-content-type="Page Builder">
                        <div className="page-content-wrapper">
                            <div className="page-breadcrumbs"></div>
                            <main className="">
                                <div className="page_content">

                                    {/* Section 1: Hero Homepage */}
                                    <section className="section" data-section-idx="1" data-section-template="Hero Homepage">
                                        <section className="hero-section">
                                            <div className="container">
                                                <div className="hero-inner-container">
                                                    <div className="hero-content">
                                                        <h1>Mandiri<br />Antusias<br />Jujur<br />Ulet</h1>
                                                        <p>Selamat Datang di SMK Purnawarman, tempat di mana potensi, inovasi, dan
                                                            karakter bersatu untuk menciptakan masa depan gemilang.</p>
                                                        <div className="hero-buttons">
                                                            <Link className="hero-btn" href="/profile-sekolah">Kenali Kami</Link>
                                                            <Link className="hero-btn hero-btn-outline" href="/dokumentasi-kegiatan">Galeri Photo</Link>
                                                        </div>
                                                    </div>
                                                    <div className="hero-image">
                                                        <img alt="SPMB SMK Purnawarman"
                                                            src="/images/website/Gambar-WhatsApp-2025-05-28-pukul-13.58.59_07ff4530.jpg" />
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </section>

                                    {/* Section 2: Keunggulan Section */}
                                    <section className="section" data-section-idx="2" data-section-template="Keunggulan Homepage">
                                        <section className="keunggulan-section">
                                            <div className="row">
                                                {/* Card Kurikulum */}
                                                <div className="col-lg-3 col-md-6 col-sm-12">
                                                    <div className="reason-card card-kurikulum">
                                                        <div className="icon">
                                                            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M20 2H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H8v-2h4V8h2v4h4v2z"></path>
                                                                <path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6z"></path>
                                                            </svg>
                                                        </div>
                                                        <h3>KURIKULUM</h3>
                                                        <p>Pembelajaran dilakukan melalui konsep kurikulum terbaru yang diinovasi
                                                            sedemikian rupa, sesuai dan sejalan dengan perkembangan zaman.</p>
                                                    </div>
                                                </div>
                                                {/* Card Kompetensi */}
                                                <div className="col-lg-3 col-md-6 col-sm-12">
                                                    <div className="reason-card card-kompetensi">
                                                        <div className="icon">
                                                            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"></path>
                                                            </svg>
                                                        </div>
                                                        <h3>KOMPETENSI</h3>
                                                        <p>Lima kompetensi keahlian yang sudah kami miliki dan kelola sejauh ini
                                                            diharapkan mampu mewakili permintaan dan sesuai dengan kebutuhan dunia kerja.</p>
                                                    </div>
                                                </div>
                                                {/* Card Sarpras */}
                                                <div className="col-lg-3 col-md-6 col-sm-12">
                                                    <div className="reason-card card-sarpras">
                                                        <div className="icon">
                                                            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z"></path>
                                                            </svg>
                                                        </div>
                                                        <h3>SARPRAS</h3>
                                                        <p>Sebagai sebuah prasyarat penting, fasilitas untuk setiap jurusan kami
                                                            persiapkan untuk menunjang pembelajaran, dan akan terus kami tingkatkan.</p>
                                                    </div>
                                                </div>
                                                {/* Card Ekstrakurikuler */}
                                                <div className="col-lg-3 col-md-6 col-sm-12">
                                                    <div className="reason-card card-ekstrakurikuler">
                                                        <div className="icon">
                                                            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"></path>
                                                            </svg>
                                                        </div>
                                                        <h3>EKSTRAKURIKULER</h3>
                                                        <p>Sebagai penunjang pengembangan minat dan bakat peserta didik, kami
                                                            mempersiapkan berbagai jenis ekstrakurikuler</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </section>

                                    {/* Section 3: Sambutan Kepala Sekolah */}
                                    <section className="section" data-section-idx="3" data-section-template="Sambutan Kepala Sekolah Homepage">
                                        <section className="sambutan-section section-padding fade-in">
                                            <div className="container">
                                                <div className="sambutan-content">
                                                    <div className="sambutan-img">
                                                        <img alt="Kepala Sekolah SMK Purnawarman" src="/images/website/prakata-1024x766.jpg" />
                                                    </div>
                                                    <div className="sambutan-text">
                                                        <h2>Sambutan Hangat dari Kami</h2>
                                                        <p className="quote">"Pendidikan adalah paspor untuk masa depan, karena hari esok
                                                            adalah milik mereka yang mempersiapkannya hari ini."</p>
                                                        <p>Di SMK Purnawarman, kami percaya bahwa setiap anak memiliki potensi unik.
                                                            Tugas kami adalah menciptakan lingkungan yang suportif, menantang, dan
                                                            inspiratif agar mereka dapat tumbuh menjadi individu yang kompeten, kreatif,
                                                            dan berakhlak mulia. Mari bersama-sama kita ukir prestasi dan wujudkan
                                                            mimpi.</p>
                                                        <p className="nama-kepsek">Uyat Sudaryat, S.T., M.M.</p>
                                                        <p>Kepala SMK Purnawarman</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </section>

                                    {/* Section 4: Aktivitas Homepage */}
                                    <section className="section" data-section-idx="4" data-section-template="Aktivitas Homepage">
                                        <section className="aktivitas-section section-padding fade-in">
                                            <div className="container">
                                                <div className="aktivitas-content">
                                                    <div className="aktivitas-text">
                                                        <h2>Chanel Aktivitas Kami</h2>
                                                        <p>Untuk memperkaya dokumentasi dan sebagai bentuk layanan informasi mengenai
                                                            kegiatan di SMK Purnawarman, maka kami arsipkan dalam chanel Youtube kami.
                                                            Silahkan klik tombol pintasan di bawah ini untuk melakukan akses.</p>
                                                        <a className="btn-youtube" href="https://www.youtube.com/@smkpn4293" target="_blank">
                                                            <i className="fab fa-youtube"></i> AKSES YOUTUBE
                                                        </a>
                                                    </div>
                                                    <div className="aktivitas-video">
                                                        <iframe
                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                            allowFullScreen="" frameBorder="0" height="315"
                                                            src="https://www.youtube.com/embed/s-etNLyqUzQ?si=4zeXIUZpVFt2z8xF"
                                                            title="YouTube video player" width="560"></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </section>

                                    {/* Section 5: Jurusan Homepage */}
                                    <section className="section" data-section-idx="5" data-section-template="Jurusan Homepage">
                                        <section className="jurusan-section section-padding fade-in" style={{ backgroundColor: 'var(--white-color)' }}>
                                            <div className="container">
                                                <h2 className="section-title">Program Keahlian Unggulan</h2>
                                                <p className="section-subtitle">Temukan passion Anda melalui beragam program keahlian yang
                                                    kami tawarkan, dirancang untuk menjawab tantangan masa depan.</p>
                                                <div className="row justify-center">
                                                    {/* Jurusan PPLG */}
                                                    <div className="col-lg-4 col-md-6 col-sm-12">
                                                        <div className="card jurusan-card">
                                                            <img alt="Pengembangan Perangkat Lunak dan Gim" className="card-img-top" src="/images/website/pplg.png" />
                                                            <div className="card-body">
                                                                <h5 className="card-title">Pengembangan Perangkat Lunak & Gim</h5>
                                                                <p className="card-text">Menjadi arsitek digital masa depan dengan menguasai coding, pengembangan aplikasi, dan pembuatan game interaktif.</p>
                                                                <Link className="btn btn-detail" href="/pengembangan-perangkat-lunak-dan-gim">Lihat Detail</Link>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {/* Jurusan MPLB */}
                                                    <div className="col-lg-4 col-md-6 col-sm-12">
                                                        <div className="card jurusan-card">
                                                            <img alt="Manajemen Perkantoran dan Layanan Bisnis" className="card-img-top" src="/images/website/mplb1.png" />
                                                            <div className="card-body">
                                                                <h5 className="card-title">Manajemen Perkantoran & Layanan Bisnis</h5>
                                                                <p className="card-text">Ahli dalam mengelola administrasi modern, layanan pelanggan prima, dan menjadi tulang punggung operasional perusahaan.</p>
                                                                <Link className="btn btn-detail" href="/manajemen-perkantoran-dan-layanan-bisnis">Lihat Detail</Link>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {/* Jurusan AKL */}
                                                    <div className="col-lg-4 col-md-6 col-sm-12">
                                                        <div className="card jurusan-card">
                                                            <img alt="Akuntansi dan Keuangan Lembaga" className="card-img-top" src="/images/website/akl.png" />
                                                            <div className="card-body">
                                                                <h5 className="card-title">Akuntansi & Keuangan Lembaga</h5>
                                                                <p className="card-text">Menjadi profesional keuangan yang andal dengan keahlian dalam pembukuan, perpajakan, dan manajemen finansial.</p>
                                                                <Link className="btn btn-detail" href="/akuntansi-dan-keuangan-lembaga">Lihat Detail</Link>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {/* Jurusan Pemasaran */}
                                                    <div className="col-lg-4 col-md-6 col-sm-12">
                                                        <div className="card jurusan-card">
                                                            <img alt="Pemasaran" className="card-img-top" src="/images/website/pms.png" />
                                                            <div className="card-body">
                                                                <h5 className="card-title">Pemasaran</h5>
                                                                <p className="card-text">Menguasai strategi pemasaran digital, branding, dan komunikasi untuk membangun merek yang kuat di era modern.</p>
                                                                <Link className="btn btn-detail" href="/pemasaran">Lihat Detail</Link>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {/* Jurusan ULP */}
                                                    <div className="col-lg-4 col-md-6 col-sm-12">
                                                        <div className="card jurusan-card">
                                                            <img alt="Usaha Layanan Pariwisata" className="card-img-top" src="/images/website/ulp.png" />
                                                            <div className="card-body">
                                                                <h5 className="card-title">Usaha Layanan Pariwisata</h5>
                                                                <p className="card-text">Membuka gerbang dunia dengan keahlian di bidang perhotelan, tour & travel, serta manajemen event pariwisata.</p>
                                                                <Link className="btn btn-detail" href="/usaha-layanan-pariwisata">Lihat Detail</Link>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </section>

                                    {/* Section 6: Pendidik dan Tenaga Kependidikan (Slider) */}
                                    <section className="section" data-section-idx="6" data-section-template="PdTK Homepage">
                                        <section className="tenaga-pendidik-section section-padding">
                                            <h2 className="section-title">Pendidik dan Tenaga Kependidikan</h2>
                                            <p className="section-subtitle"> Di balik siswa yang hebat, ada para pendidik berdedikasi yang
                                                tak kenal lelah membimbing, menginspirasi, dan membentuk masa depan. </p>
                                            <div className="slider-container">
                                                <div className="slider-wrapper" id="slider-wrapper">
                                                    {teachers.map((teacher, index) => (
                                                        <div className="guru-card" key={index}>
                                                            <div className="guru-img">
                                                                <img alt={teacher.name} src={teacher.img} />
                                                            </div>
                                                            <h3 className="guru-nama">{teacher.name}</h3>
                                                            <p className="guru-jabatan">{teacher.title}</p>
                                                            <p className="guru-mapel">{teacher.subject}</p>
                                                        </div>
                                                    ))}
                                                </div>
                                                <button aria-label="Slide Sebelumnya" className="slider-btn prev-btn">
                                                    <svg fill="none" stroke="currentColor" strokeWidth="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M15.75 19.5 8.25 12l7.5-7.5" strokeLinecap="round" strokeLinejoin="round"></path>
                                                    </svg>
                                                </button>
                                                <button aria-label="Slide Selanjutnya" className="slider-btn next-btn">
                                                    <svg fill="none" stroke="currentColor" strokeWidth="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="m8.25 4.5 7.5 7.5-7.5 7.5" strokeLinecap="round" strokeLinejoin="round"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div className="slider-dots" id="slider-dots"></div>
                                            <Link className="btn-selengkapnya" href="/pendidik-dan-tenaga-kependidikan">Lihat Selengkapnya</Link>
                                        </section>
                                    </section>

                                    {/* Section 7: Blog Homepage */}
                                    <section className="section" data-section-idx="7" data-section-template="Blog Homepage">
                                        <section className="berita-section section-padding fade-in">
                                            <div className="container">
                                                <h2 className="section-title">Blog & Kegiatan Terbaru</h2>
                                                <p className="section-subtitle">Ikuti terus informasi, prestasi, dan berbagai kegiatan
                                                    menarik yang berlangsung di lingkungan sekolah kami.</p>
                                                <div className="row">
                                                    {/* Card Berita 1 */}
                                                    <div className="col-lg-4 col-md-4 col-sm-12">
                                                        <div className="berita-card">
                                                            <img alt="Siswa Berprestasi menerima penghargaan" className="card-img-top"
                                                                src="/images/website/Gambar-WhatsApp-2025-07-15-pukul-20.18.14_ced186c6-1536x864.jpg" />
                                                            <div className="card-body">
                                                                <p className="card-date">15 JULI 2025</p>
                                                                <h5 className="card-title">
                                                                    <Link href="/berita/lomba-siswa">SMK Purnawarman Gelar Keputra-putrian, Tingkatkan Karakter Religius Siswa</Link>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {/* Card Berita 2 */}
                                                    <div className="col-lg-4 col-md-4 col-sm-12">
                                                        <div className="berita-card">
                                                            <img alt="Mengenal Deep Learning" className="card-img-top"
                                                                src="/images/website/deep-learning-1-1024x579.jpg" />
                                                            <div className="card-body">
                                                                <p className="card-date">15 JULI 2025</p>
                                                                <h5 className="card-title">
                                                                    <Link href="/berita/lomba-siswa">Mengenal Deep Learning</Link>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {/* Card Berita 3 */}
                                                    <div className="col-lg-4 col-md-4 col-sm-12">
                                                        <div className="berita-card">
                                                            <img alt="Workshop Industri di sekolah" className="card-img-top"
                                                                src="/images/website/IMG-20250707-WA0037-edited-1536x1152.jpg" />
                                                            <div className="card-body">
                                                                <p className="card-date">15 JULI 2025</p>
                                                                <h5 className="card-title">
                                                                    <Link href="/berita/kunjungan-industri">Pendidikan: Kunci Emas Menuju Masa Depan Gemilang!</Link>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <Link className="btn-semua-berita" href="/blog">Lihat Semua Berita</Link>
                                            </div>
                                        </section>
                                    </section>

                                    {/* Section 8: CTA Homepage */}
                                    <section className="section" data-section-idx="8" data-section-template="CTA Homepage">
                                        <section className="cta-section section-padding">
                                            <div className="container">
                                                <h2>Siap Menjadi Bagian dari Kisah Sukses Kami?</h2>
                                                <p>Jangan tunda lagi, daftarkan diri Anda sekarang dan mulailah perjalanan menuju masa
                                                    depan yang cerah bersama SMK Purnawarman.</p>
                                                <Link className="cta-btn" href="/pendaftaran">Daftar Sekarang</Link>
                                            </div>
                                        </section>
                                    </section>
                                </div>
                            </main>
                        </div>
                    </div>
                </div>
            </PublicLayout>
        </>
    );
}
