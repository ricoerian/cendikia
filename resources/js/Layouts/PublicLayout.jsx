import React, { useEffect, useState } from 'react';
import { Link } from '@inertiajs/react';
import '../../css/style.css';

export default function PublicLayout({ children }) {
    const [isMenuOpen, setIsMenuOpen] = useState(false);
    const [isSticky, setIsSticky] = useState(false);
    const [activeDropdown, setActiveDropdown] = useState(null);

    useEffect(() => {
        const topBar = document.querySelector('.top-bar');
        const navbar = document.getElementById('main-navbar');
        if (!topBar || !navbar) return;

        const stickyPoint = topBar.offsetHeight;
        const header = document.getElementById('custom-header');

        const handleScroll = () => {
            if (window.scrollY > stickyPoint) {
                if (!isSticky) {
                    setIsSticky(true);
                    if (header) header.style.paddingBottom = `${navbar.offsetHeight}px`;
                }
            } else {
                if (isSticky) {
                    setIsSticky(false);
                    if (header) header.style.paddingBottom = '0';
                }
            }
        };

        window.addEventListener('scroll', handleScroll);
        return () => window.removeEventListener('scroll', handleScroll);
    }, [isSticky]);

    useEffect(() => {
        const body = document.body;
        const navToggle = document.getElementById('nav-toggle');
        const navOverlay = document.getElementById('nav-overlay');
        
        body.classList.toggle('nav-open', isMenuOpen);
        
        if (navToggle) {
            navToggle.setAttribute('aria-expanded', isMenuOpen.toString());
        }

        if (navOverlay) {
            navOverlay.classList.toggle('active', isMenuOpen);
        }
    }, [isMenuOpen]);

    // Handle mobile dropdown clicks
    const handleDropdownClick = (e, dropdownName) => {
        if (window.innerWidth <= 1024) {
            e.preventDefault();
            setActiveDropdown(prev => prev === dropdownName ? null : dropdownName);
        }
    };

    // Handle desktop hover
    const handleMouseEnter = (dropdownName) => {
        if (window.innerWidth > 1024) {
            setActiveDropdown(dropdownName);
        }
    };

    const handleMouseLeave = () => {
        if (window.innerWidth > 1024) {
            setActiveDropdown(null);
        }
    };

    const toggleMenu = () => {
        setIsMenuOpen(!isMenuOpen);
        setActiveDropdown(null);
    };

    useEffect(() => {
        const backToTopBtn = document.querySelector('.back-to-top-btn');
        if (!backToTopBtn) return;

        const handleScroll = () => {
            if (window.scrollY > 300) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        };

        window.addEventListener('scroll', handleScroll);
        return () => window.removeEventListener('scroll', handleScroll);
    }, []);

    // Close dropdown when clicking outside
    useEffect(() => {
        const handleClickOutside = (e) => {
            if (!e.target.closest('.dropdown') && window.innerWidth <= 1024) {
                setActiveDropdown(null);
            }
        };

        document.addEventListener('click', handleClickOutside);
        return () => document.removeEventListener('click', handleClickOutside);
    }, []);

    const currentYear = new Date().getFullYear();

    // Inline styles for dropdown menu to ensure it works
    const dropdownMenuStyle = (dropdownName) => ({
        display: window.innerWidth <= 1024 
            ? (activeDropdown === dropdownName ? 'block' : 'none')
            : 'block',
        opacity: window.innerWidth > 1024 
            ? (activeDropdown === dropdownName ? '1' : '0')
            : '1',
        visibility: window.innerWidth > 1024
            ? (activeDropdown === dropdownName ? 'visible' : 'hidden')
            : 'visible',
        transform: window.innerWidth > 1024
            ? (activeDropdown === dropdownName ? 'translateY(0)' : 'translateY(10px)')
            : 'none',
        transition: window.innerWidth > 1024 
            ? 'opacity 0.3s ease, transform 0.3s ease, visibility 0.3s'
            : 'none',
        position: 'absolute',
        top: '100%',
        left: '0',
        backgroundColor: '#ffffff',
        boxShadow: '0 0.5rem 1.25rem rgba(0, 0, 0, 0.1)',
        listStyle: 'none',
        borderRadius: '0.5rem',
        minWidth: '16.25rem',
        borderTop: '0.1875rem solid var(--secondary-color)',
        zIndex: 1001,
        padding: '0.5rem 0'
    });
    
    return (
        <>
            <link type="text/css" rel="stylesheet" href="/css/website.bundle.css" />
            <link type="text/css" rel="stylesheet" href="/css/web.bundle.css" />
            <header className="custom-header" id="custom-header">
                <div className="top-bar">
                    <div className="container">
                        <div className="top-bar-contact">
                            <span><i className="fa-brands fa-whatsapp"></i> 085794545124 - 082122178413</span>
                            <span><i className="fa-regular fa-envelope"></i>info@smkpurnawarman.sch.id</span>
                        </div>
                        <div className="top-bar-social">
                            <a aria-label="Facebook" href="#" target="_blank"><i className="fab fa-facebook-f"></i></a>
                            <a aria-label="Instagram" href="#" target="_blank"><i className="fab fa-instagram"></i></a>
                            <a aria-label="YouTube" href="#" target="_blank"><i className="fab fa-youtube"></i></a>
                            <a aria-label="TikTok" href="#" target="_blank"><i className="fab fa-tiktok"></i></a>
                        </div>
                    </div>
                </div>
                <nav className={`main-navbar ${isSticky ? 'navbar-is-sticky' : ''}`} id="main-navbar">
                    <div className="container">
                        <Link className="navbar-brand" href="/">
                            <img alt="Logo SMK Purnawarman" src="/images/website/splash.webp" />
                        </Link>
                        <button
                            aria-controls="nav-links"
                            aria-expanded={isMenuOpen}
                            aria-label="Toggle navigation"
                            className={`nav-toggle ${isMenuOpen ? 'active' : ''}`}
                            id="nav-toggle"
                            onClick={toggleMenu}>
                            <span className="bar"></span>
                            <span className="bar"></span>
                            <span className="bar"></span>
                        </button>
                        <ul className={`nav-links ${isMenuOpen ? 'active' : ''}`} id="nav-links">
                            <li><Link href="/">Home</Link></li>
                            
                            <li className={`dropdown ${activeDropdown === 'tentang' && window.innerWidth <= 1024 ? 'active' : ''}`}
                                onMouseEnter={() => handleMouseEnter('tentang')}
                                onMouseLeave={handleMouseLeave}>
                                <a 
                                    aria-haspopup="true" 
                                    href="#" 
                                    data-dropdown="tentang"
                                    onClick={(e) => handleDropdownClick(e, 'tentang')}
                                    style={{
                                        color: activeDropdown === 'tentang' ? 'var(--secondary-color)' : undefined
                                    }}
                                >
                                    Tentang Kami <i className="fas fa-chevron-down" style={{
                                        transform: activeDropdown === 'tentang' ? 'rotate(180deg)' : 'rotate(0deg)',
                                        transition: 'transform 0.3s ease'
                                    }}></i>
                                </a>
                                <ul className="dropdown-menu" style={dropdownMenuStyle('tentang')}>
                                    <li><Link href="/profile-sekolah">Profile Sekolah</Link></li>
                                    <li><Link href="/sejarah-singkat">Sejarah Singkat</Link></li>
                                    <li><Link href="/pendidik-dan-tenaga-kependidikan">Pendidik dan Tenaga Kependidikan</Link></li>
                                </ul>
                            </li>
                            
                            <li className={`dropdown ${activeDropdown === 'program' && window.innerWidth <= 1024 ? 'active' : ''}`}
                                onMouseEnter={() => handleMouseEnter('program')}
                                onMouseLeave={handleMouseLeave}>
                                <a 
                                    aria-haspopup="true" 
                                    href="#" 
                                    data-dropdown="program"
                                    onClick={(e) => handleDropdownClick(e, 'program')}
                                    style={{
                                        color: activeDropdown === 'program' ? 'var(--secondary-color)' : undefined
                                    }}
                                >
                                    Program Keahlian <i className="fas fa-chevron-down" style={{
                                        transform: activeDropdown === 'program' ? 'rotate(180deg)' : 'rotate(0deg)',
                                        transition: 'transform 0.3s ease'
                                    }}></i>
                                </a>
                                <ul className="dropdown-menu" style={dropdownMenuStyle('program')}>
                                    <li><Link href="/pengembangan-perangkat-lunak-dan-gim">Pengembangan Perangkat Lunak dan Gim</Link></li>
                                    <li><Link href="/manajemen-perkantoran-dan-layanan-bisnis">Manajemen Perkantoran dan Layanan Bisnis</Link></li>
                                    <li><Link href="/akuntansi-dan-keuangan-lembaga">Akuntansi dan Keuangan Lembaga</Link></li>
                                    <li><Link href="/pemasaran">Pemasaran</Link></li>
                                    <li><Link href="/usaha-layanan-pariwisata">Usaha Layanan Pariwisata</Link></li>
                                </ul>
                            </li>
                            
                            <li className={`dropdown ${activeDropdown === 'ekstra' && window.innerWidth <= 1024 ? 'active' : ''}`}
                                onMouseEnter={() => handleMouseEnter('ekstra')}
                                onMouseLeave={handleMouseLeave}>
                                <a 
                                    aria-haspopup="true" 
                                    href="#" 
                                    data-dropdown="ekstra"
                                    onClick={(e) => handleDropdownClick(e, 'ekstra')}
                                    style={{
                                        color: activeDropdown === 'ekstra' ? 'var(--secondary-color)' : undefined
                                    }}
                                >
                                    Ekstrakulikuler <i className="fas fa-chevron-down" style={{
                                        transform: activeDropdown === 'ekstra' ? 'rotate(180deg)' : 'rotate(0deg)',
                                        transition: 'transform 0.3s ease'
                                    }}></i>
                                </a>
                                <ul className="dropdown-menu" style={dropdownMenuStyle('ekstra')}>
                                    <li><Link href="/pramuka">Pramuka</Link></li>
                                    <li><Link href="/paskibra">Paskibra</Link></li>
                                    <li><Link href="/palang-merah-remaja">Palang Merah Remaja</Link></li>
                                    <li><Link href="/marching-band">Marching Band</Link></li>
                                    <li><Link href="/kesenian">Kesenian</Link></li>
                                    <li><Link href="/olahraga">Olahraga</Link></li>
                                    <li><Link href="/jujitsu">Jujitsu</Link></li>
                                </ul>
                            </li>
                            
                            <li className={`dropdown ${activeDropdown === 'kesiswaan' && window.innerWidth <= 1024 ? 'active' : ''}`}
                                onMouseEnter={() => handleMouseEnter('kesiswaan')}
                                onMouseLeave={handleMouseLeave}>
                                <a 
                                    aria-haspopup="true" 
                                    href="#" 
                                    data-dropdown="kesiswaan"
                                    onClick={(e) => handleDropdownClick(e, 'kesiswaan')}
                                    style={{
                                        color: activeDropdown === 'kesiswaan' ? 'var(--secondary-color)' : undefined
                                    }}
                                >
                                    Kesiswaan <i className="fas fa-chevron-down" style={{
                                        transform: activeDropdown === 'kesiswaan' ? 'rotate(180deg)' : 'rotate(0deg)',
                                        transition: 'transform 0.3s ease'
                                    }}></i>
                                </a>
                                <ul className="dropdown-menu" style={dropdownMenuStyle('kesiswaan')}>
                                    <li><Link href="/osis-mpk-smk-purnawarman">OSIS/MPK</Link></li>
                                    <li><Link href="/dokumentasi-kegiatan">Dokumentasi Kegiatan</Link></li>
                                    <li><Link href="/testimoni-alumni">Testimoni Alumni</Link></li>
                                    <li><Link href="/download">Download</Link></li>
                                </ul>
                            </li>
                            
                            <li><Link href="/blog">Blog</Link></li>
                            <li><Link href="/kontak-kami">Kontak</Link></li>
                            <li className="nav-btn"><Link href="/pendaftaran">Daftar Sekarang</Link></li>
                        </ul>
                    </div>
                </nav>
            </header>
            <div className="nav-overlay" id="nav-overlay" onClick={toggleMenu}></div>
            
            {children}
            
            <a className="back-to-top-btn" href="#" title="Kembali ke atas" onClick={(e) => {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }}>
                ⇧
            </a>

            <footer className="custom-footer-wrapper">
                <div className="container">
                    <div className="footer-top-content">
                        <div className="footer-column footer-about">
                            <h5>Tentang SMK Purnawarman</h5>
                            <img alt="Logo SMK Purnawarman" className="footer-logo" src="/images/website/logo.png" />
                            <p>Mencetak generasi muda yang kompeten, berakhlak mulia, dan siap bersaing di dunia kerja.</p>
                            <div className="contact-info">
                                <p><i className="fas fa-map-marker-alt"></i>Jl. Jend. A. Yani No. 172 Cipaisan, Purwakarta 41113</p>
                                <p><i className="fab fa-whatsapp"></i>085794545124 - 082122178413</p>
                                <p><i className="fa-regular fa-envelope"></i>info@smkpurnawarman.sch.id</p>
                            </div>
                        </div>
                        <div className="footer-column footer-links">
                            <h5>Tautan Cepat</h5>
                            <ul>
                                <li><Link href="/profile-sekolah">Profil Sekolah</Link></li>
                                <li><Link href="/program-keahlian">Program Keahlian</Link></li>
                                <li><Link href="/berita">Berita Terbaru</Link></li>
                                <li><Link href="/pendaftaran">Pendaftaran</Link></li>
                                <li><Link href="/kontak-kami">Kontak Kami</Link></li>
                            </ul>
                        </div>
                        <div className="footer-column footer-social">
                            <h5>Terhubung Dengan Kami</h5>
                            <p>Ikuti kami di media sosial untuk mendapatkan informasi terbaru seputar kegiatan sekolah.</p>
                            <div className="social-icons">
                                <a aria-label="Facebook" href="#" target="_blank"><i className="fab fa-facebook-f"></i></a>
                                <a aria-label="Instagram" href="#" target="_blank"><i className="fab fa-instagram"></i></a>
                                <a aria-label="YouTube" href="#" target="_blank"><i className="fab fa-youtube"></i></a>
                                <a aria-label="TikTok" href="#" target="_blank"><i className="fab fa-tiktok"></i></a>
                            </div>
                        </div>
                    </div>
                    <div className="footer-map-section">
                        <h5>Kunjungi Lokasi Kami</h5>
                        <div className="map-container">
                            <iframe 
                                allowFullScreen="" 
                                height="450" 
                                loading="lazy" 
                                referrerPolicy="no-referrer-when-downgrade"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.794912148565!2d107.4373636989384!3d-6.547560128877292!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e690fe4120dd919%3A0xe9785b887256d869!2sSMK%20Purnawarman%20Purwakarta!5e0!3m2!1sid!2sid!4v1758380768924!5m2!1sid!2sid" 
                                style={{ border: 0 }} 
                                width="600">
                            </iframe>
                        </div>
                    </div>
                </div>
                <div className="footer-bottom">
                    <div className="container">
                        <p className="copyright">© <span>{currentYear}</span> <strong>SMK Purnawarman</strong>. All Rights Reserved.</p>
                        <p className="designer">Website Designed by <strong>Rico Eriansyah</strong></p>
                    </div>
                </div>
            </footer>
        </>
    );
}