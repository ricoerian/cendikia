import React, { useState, useEffect } from 'react';
import { Head } from '@inertiajs/react';
import PublicLayout from '@/Layouts/PublicLayout';

const StaffCard = ({ staff, onOpenModal }) => {
    const imageStyle = {
        backgroundImage: `url('${staff.image}')`
    };

    return (
        <div 
            data-staff-id={staff.id} 
            className="staff-card bg-white rounded-lg shadow-lg overflow-hidden text-center group transform hover:scale-105 transition-transform duration-300 cursor-pointer"
            onClick={() => onOpenModal(staff)}
        >
            <div className="h-64 bg-cover bg-center" style={imageStyle}></div>
            <div className="p-5 flex flex-col items-center justify-center space-y-4">
                <p className="text-lg font-bold font-playfair mb-1">{staff.name}</p>
                <p className="text-sm main-color font-semibold mt-1">{staff.position}</p>
                <p className="text-xs text-gray-500 mt-2">{staff.description}</p>
            </div>
        </div>
    );
};

const StaffModal = ({ staff, isOpen, onClose }) => {
    useEffect(() => {
        const handleEscape = (event) => {
            if (event.key === 'Escape') {
                onClose();
            }
        };

        if (isOpen) {
            document.body.style.overflow = 'hidden'; 
            window.addEventListener('keydown', handleEscape);
        } else {
            document.body.style.overflow = '';
        }

        return () => {
            document.body.style.overflow = '';
            window.removeEventListener('keydown', handleEscape);
        };
    }, [isOpen, onClose]);

    if (!staff || !isOpen) return null;

    return (
        <div 
            className="fixed inset-0 bg-black bg-opacity-50 z-[1000] flex items-center justify-center transition-opacity duration-300 active"
            onClick={onClose} 
        >
            <div className="modal-content bg-white rounded-lg p-8 m-4 max-w-2xl w-full relative" onClick={e => e.stopPropagation()}>
                <button 
                    className="modal-close absolute top-4 right-4 text-gray-600 hover:text-gray-800"
                    onClick={onClose}
                >
                    <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 18L18 6M6 6l12 12" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"></path>
                    </svg>
                </button>
                <div className="modal-body flex flex-row items-center text-center space-x-4">
                    <img 
                        className="w-36 h-36 md:w-48 md:h-48 object-cover rounded-md flex-shrink-0 shadow-lg" 
                        src={staff.image} 
                        alt={staff.name} 
                    />
                    <div className='p-5 flex flex-col items-start text-left space-y-4'>
                        <p className="text-2xl font-bold font-playfair mb-1">{staff.name}</p>
                        <p className="text-md main-color font-semibold mt-1">{staff.position}</p>
                        <p className="text-gray-600 italic mt-2">"{staff.quote}"</p>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default function PendidikDanTenagaKependidikan() {
    const [selectedStaff, setSelectedStaff] = useState(null);
    const [isModalOpen, setIsModalOpen] = useState(false);

    const staffData = [
        { id: 'uyat', name: 'Uyat Sudaryat, S.T., M.M.', position: 'Kepala Sekolah', description: 'Kepala SMK Purnawarman Purwakarta', quote: 'Mencintai ilmu pengetahuan itu merupakan suatu hal yang menyenangkan.', image: '/images/website/IMG-20240902-WA0040-rotated-e1752724979795-1024x1024.jpg' },
        { id: 'santi', name: 'Santi Tri Astuti, S.M.', position: 'Waka Bidang Kurikulum', description: 'Guru Mapel Produktif ULP', quote: 'Mencintai ilmu pengetahuan itu merupakan suatu hal yang menyenangkan.', image: '/images/website/IMG-20250702-WA0043-1024x1024.jpg' },
        { id: 'slamet', name: 'Slamet Kuatno, S.Pd', position: 'Waka Bidang Kesiswaan', description: 'Guru Mapel PJOK', quote: 'Mencintai ilmu pengetahuan itu merupakan suatu hal yang menyenangkan.', image: '/images/website/Slamet-Kuatno-S.Pd_-e1752591548514.jpg' },
        { id: 'ferlina', name: 'Ferlina Effendy, S.E.', position: 'Pengelola Keuangan', description: 'Guru Mapel Produktif PMS', quote: 'Mencintai ilmu pengetahuan itu merupakan suatu hal yang menyenangkan.', image: '/images/website/momfer.jpg' },
        { id: 'ika', name: 'Ika Indriana Astuti, S.Kom', position: 'Kepala Kompetensi Keahlian PPLG', description: 'Guru Mapel Produktif PPLG', quote: 'Mencintai ilmu pengetahuan itu merupakan suatu hal yang menyenangkan.', image: '/images/website/Gambar-WhatsApp-2025-07-17-pukul-05.33.19_8cf74797-e1752723601829.jpg' },
        { id: 'tuti', name: 'Tuti Choiriyah, S.E.', position: 'Kepala Kompetensi Keahlian MPLB', description: 'Guru Mapel Produktif MPLB', quote: "Lakukanlah yang terbaik selagi ada kesempatan, karena kesempatan tidak datang untuk yang ke dua kalinya. Believe you can and you're halfway there", image: '/images/website/Tuti-Choiriyah.jpg' },
        { id: 'jejen', name: 'Jejen Nujaenah, S.Pd', position: 'Kepala Kompetensi Keahlian AKL', description: 'Guru Mapel Produktif AKL', quote: 'Mencintai ilmu pengetahuan itu merupakan suatu hal yang menyenangkan.', image: '/images/website/20230302_064233_C12F2AA1-1C29-4496-9C99-03A1DA62D057_Original-e1752630958194-1022x1024.jpg' },
        { id: 'crista', name: 'Crista Bella Cikitha, S.E.', position: 'Kepala Kompetensi Keahlian Pemasaran', description: 'Guru Mapel Produktif Pemasaran', quote: 'Mencintai ilmu pengetahuan itu merupakan suatu hal yang menyenangkan.', image: '/images/website/Gambar-WhatsApp-2025-07-16-pukul-09.05.46_58e7e85b-e1752631854756.jpg' },
        { id: 'tita', name: 'Tita Devita, S.Tr.Par.', position: 'Kepala Kompetensi Keahlian ULP', description: 'Guru Mapel Produktif ULP', quote: "Please be a traveler, not a tourist. Try new things, meet new people, and look beyond what's right in front of you. Those are the keys to understanding this amazing world we live in.", image: '/images/website/tita-devita.jpg' },
        { id: 'ina', name: 'Ina Rostiana, S.Pd', position: 'Pembina IRMA', description: 'Guru Mapel Pendidikan Agama Islam', quote: '“Kemarin saya merasa pintar, oleh karena itu saya ingin mengubah dunia. Tapi hari ini saya menjadi orang yang lebih bijak, oleh karena itu saya ingin mengubah diriku sendiri” - Jalaluddin Rumi', image: '/images/website/Ina-Rostiana.S.Pd_-e1752728403103-1024x1024.jpg' },
        { id: 'indah', name: 'Indah Ayu Lestari, S.Pd', position: 'Pembina OSIS', description: 'Guru Mapel Bahasa Indonesia', quote: 'Mencintai ilmu pengetahuan itu merupakan suatu hal yang menyenangkan.', image: '/images/website/Indah-Ayu-L-S.Pd_.jpg' },
        { id: 'ergyana', name: 'Ergyana Pratiwi, S.Pd', position: 'Pembina Marching Band', description: 'Guru Mapel Bahasa Inggris', quote: 'Kejujuran adalah kesederhanaan yang mewah.', image: '/images/website/ergy.jpg' },
        { id: 'lastri', name: 'Lastri Susilawati, S.Pd', position: 'Guru', description: 'Guru Mapel Bahasa Sunda', quote: '“Pengabdian terbaik adalah pengabdian dengan keikhlasan."', image: '/images/website/bulastri.jpg' },
        { id: 'sarah', name: 'Siti Sarah Shehnaz, S.Pd', position: 'Guru', description: 'Guru Mapel Bahasa Inggris', quote: `"Never regret a day in your life. good days give happiness, bad days give experiences, worst day give lessons, and best day give memories 😊"`, image: '/images/website/Siti-Sarah-Shehnaz-S.Pd_.jpg' },
        { id: 'tika', name: 'Tika Puri Hermayanti, S.Pd', position: 'Guru', description: 'Guru Mapel Matematika', quote: 'Kejujuran adalah kesederhanaan yang mewah.', image: '/images/website/Gambar-WhatsApp-2025-07-16-pukul-13.43.36_8f6a9070.jpg' },
        { id: 'laras', name: 'Laras Siti Syarah, S.Pd', position: 'Guru', description: 'Guru Mapel IPAS', quote: '“Kegagalan tidak memberimu alasan untuk menyerah, selama kamu percaya pada dirimu sendiri"', image: '/images/website/laras.jpg' },
        { id: 'nurul', name: 'Nurul Fatul Jannah, S.Pd', position: 'Guru', description: 'Guru Bimbingan Konseling', quote: 'Fokus pada Tujuan bukan Hambatan, Yakinlah kamu bisa melewati semuanya', image: '/images/website/Nurul-Fatul-Jannah-S.Pd_.jpg' },
        { id: 'hesti', name: 'Hesti Purwati, S.Pd', position: 'Guru', description: 'Guru Mapel SBK', quote: `Teruslah berkarya sampai kamu tidak perlu memperkenalkan diri pada siapapun. “Dream, believe, and make it happen”`, image: '/images/website/hesti.jpg' },
        { id: 'nia', name: 'Nia Kurniawan, S.Kom', position: 'Pengelola Website', description: 'Guru Produktif PPLG', quote: 'Tidak berhenti berdoa, tidak berhenti belajar, mencintai ilmu, dan jadilah manusia paripurna', image: '/images/website/abahonje-1024x1024.jpg' },
        { id: 'rico', name: 'Rico Eriansyah, A.Md.T', position: 'Kepala Laboratorium Komputer', description: 'Kepala Laboratorium Komputer & Guru Produktif PPLG', quote: 'Jangan pernah berhenti belajar, kecuali tuhan mencabut nyawamu!', image: '/images/website/rico.png' },
        { id: 'firda', name: 'Firda Maulani Lestari, S.Pd', position: 'Guru', description: 'Guru Produktif MPLB', quote: 'Nikmati setiap prosesnya, jangan pernah takut melangkah, dan yakinlah yang terbaik untuk diri kita tak akan pernah tersesat menemukan jalannya.', image: '/images/website/Firda-Maulani-Lestari-S.Pd_-1-1024x1024.jpg' },
        { id: 'putri', name: 'Putri Rindiasari, S.Pd', position: 'Guru', description: 'Guru Bimbingan Konseling', quote: '“Mencintai diri sendiri sebelum mencintai orang lain, tetaplah menjadi baik, jangan bosan jadi orang baik "', image: '/images/website/putri.jpg' },
        { id: 'rida', name: 'Rida Damayanti, S.Pd', position: 'Guru', description: 'Guru Mapel Bahasa Indonesia', quote: 'Jangan pernah menyerah pada impianmu, karena kesuksesan adalah hasil dari kerja keras dan ketekunan.', image: '/images/website/Rida-Damayanti-S.Pd_-1024x1024.jpg' },
        { id: 'syifa', name: 'Syifa Fiainunisa Anugrah, S.Pd', position: 'Guru', description: 'Guru Produktif ULP', quote: 'Kalau sewaktu kamu merasa kosong dan perlu sesuatu yang diisi. Kamu bisa isi semuanya dengan cinta, cinta kepada sang pencipta, orang tersayang, alam semesta, juga tanam cinta untuk diri sendiri. Berbahagialah jika nantinya kamu bisa berdamai dengan diri sendiri.', image: '/images/website/Syifa-Fiainunisa-Anugrah-S.Pd_.jpg' },
        { id: 'geby', name: 'Geby Masita Abdul, S.Pd', position: 'Guru', description: 'Guru Mapel Pendidikan Pancasila', quote: "Keberuntungan harus bersahabat dengan do'a.", image: '/images/website/Geby-Masita-Abdul-S.Pd_.jpg' }
    ];

    const handleOpenModal = (staff) => {
        setSelectedStaff(staff);
        setIsModalOpen(true);
    };

    const handleCloseModal = () => {
        setIsModalOpen(false);
        setTimeout(() => setSelectedStaff(null), 300); 
    };


    return (
        <>
            <Head title="Pendidik dan Tenaga Kependidikan - SMK Purnawarman" />
            <PublicLayout>
                <section className="section" data-section-idx="1" data-section-template="Hero PdTK">
                    <section className="hero-bg py-16 md:py-24">
                        <div className="container mx-auto px-4 md:px-8">
                            <div className="flex flex-col md:flex-row items-center justify-center text-center md:text-left gap-8">
                                <img alt="Logo Sekolah" className="w-32 h-32 md:w-40 md:h-40" src="https://smkpurnawarman.org/wp-content/uploads/2025/07/cropped-logo.png" />
                                <div>
                                    <h4 className="text-lg md:text-xl font-semibold text-gray-600">SEKOLAH MENENGAH KEJURUAN</h4>
                                    <h2 className="text-4xl md:text-6xl font-bold font-playfair mt-1">PURNAWARMAN</h2>
                                    <h3 className="text-2xl md:text-3xl font-playfair text-gray-700 mt-2">PENDIDIK DAN TENAGA KEPENDIDIKAN</h3>
                                </div>
                            </div>
                            <div className="max-w-4xl mx-auto text-center mt-8">
                                <p className="text-base md:text-lg leading-relaxed">
                                    Sekolah Menengah Kejuruan (SMK) Purnawarman Purwakarta merupakan lembaga pendidikan yang berada di bawah
                                    naungan Yayasan Pendidikan Purnawarman, memiliki Lim Kompetensi Keahlian yang terakreditasi “A”,
                                    yaitu Pengembangan Perangkat Lunak dan Gim, Manajemen Perkantoran dan Layanan Bisnis, Akuntansi dan
                                    Keuangan Lembaga, Pemasaran, dan Usaha Layanan Pariwisata.
                                </p>
                                <div className="w-24 h-1 bg-gray-300 mx-auto mt-8"></div>
                            </div>
                        </div>
                    </section>
                </section>
                
                <section className="section section-padding-top section-padding-bottom" data-section-idx="2" data-section-template="Staff PdTK">
                    <div className="container mx-auto px-4 md:px-8">
                        <section className="py-16 md:py-20 bg-white">
                            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-8" id="staff-grid">
                                {staffData.map((staff) => (
                                    <StaffCard 
                                        key={staff.id} 
                                        staff={staff} 
                                        onOpenModal={handleOpenModal}
                                    />
                                ))}
                            </div>
                        </section>
                    </div>
                </section>

                <StaffModal 
                    staff={selectedStaff} 
                    isOpen={isModalOpen} 
                    onClose={handleCloseModal} 
                />
                
            </PublicLayout>
        </>
    );
}