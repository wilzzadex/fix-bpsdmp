@extends('front.master')
@section('content')
<section id="page-title">

    <div class="container clearfix">
        <h1>Laporan Diklat Pemberdayaan Masyarakat</h1>
        <!-- <span>Powerful Form Processor</span> -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Publikasi</a></li>
            <li class="breadcrumb-item"><a href="#">Laporan Diklat Pemberdayaan Masyarakat</a></li>
            <!-- <li class="breadcrumb-item active" aria-current="page">BPSDMP SELENGGARAKAN WISUDA DAN TRADISI BON VOYAGE BAGI LULUSAN MASTER KEPELAUTAN BP3IP -->
            </li>
        </ol>
    </div>

</section>
<section id="content" style="margin-bottom: 0px;">

    <div class="content-wrap">

        <div class="container clearfix">
            <div class="row">
                <div class="col-md-12">



                    <div class="tabs tabs-responsive clearfix">

                        <ul class="tab-nav clearfix">
                            <li><a href="#tab-responsive-1">Semua Matra</a></li>
                            <li><a href="#tab-responsive-2">Darat</a></li>
                            <li><a href="#tab-responsive-3">Laut</a></li>
                            <li class="hidden-phone"><a href="#tab-responsive-4">Udara</a></li>
                        </ul>

                        <div class="tab-container">

                            <div class="tab-content clearfix" id="tab-responsive-1">
                                <div class="row" style="border: 1px solid black;">
                                    <div class="col-md-6">
                                        <div>
                                            <figure class="highcharts-figure">
                                                <div id="container"></div>
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <div id="chart"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table table-striped table-bordered table-full-width">
                                            <thead>
                                                <tr>
                                                    <td rowspan="3" valign="middle">NO</td>
                                                    <td rowspan="3">KATEGORI DIKLAT</td>
                                                    <td rowspan="3">TARGET PESERTA</td>
                                                    <td colspan="6">KATEGORI LATAR BELAKANG</td>
                                                    <td rowspan="3">TOTAL REALISASI PESERTA</td>
                                                    <td rowspan="3">%</td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2">UMUM</th>
                                                    <th colspan="2">SMK</th>
                                                    <th colspan="2">ASN</th>
                                                </tr>
                                                <tr>
                                                    <th>L</th>
                                                    <th>P</th>
                                                    <th>L</th>
                                                    <th>P</th>
                                                    <th>L</th>
                                                    <th>P</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl_diklat">
                                                <tr>
                                                    <td>1</td>
                                                    <td>KESELAMATAN</td>
                                                    <td>54.421</td>
                                                    <td>23.702</td>
                                                    <td>1.710</td>
                                                    <td>2.154</td>
                                                    <td>441</td>
                                                    <td>354</td>
                                                    <td>73</td>
                                                    <td>29.423</td>
                                                    <td>54%</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>COMMUNITY DEVELOPMENT</td>
                                                    <td>2.128</td>
                                                    <td>2.561</td>
                                                    <td>57</td>
                                                    <td>9</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>2.652</td>
                                                    <td>125%</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>REVITALISASI SMK</td>
                                                    <td>4.746</td>
                                                    <td>1.187</td>
                                                    <td>81</td>
                                                    <td>3.407</td>
                                                    <td>714</td>
                                                    <td>14</td>
                                                    <td>1</td>
                                                    <td>5.444</td>
                                                    <td>115%</td>
                                                </tr>
                                                <tr class="tfoot">
                                                    <td colspan="2">TOTAL</td>
                                                    <td>61.295</td>
                                                    <td>27.450</td>
                                                    <td>1.848</td>
                                                    <td>5.570</td>
                                                    <td>1.155</td>
                                                    <td>368</td>
                                                    <td>74</td>
                                                    <td>37.519</td>
                                                    <td>61%</td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <div class="row" style="border: 1px solid black;">
                                    <div class="col-md-12">
                                        <div id="indonesia_maps"></div>
                                    </div>
                                    <div class="col-12 mb-5">
                                        <div style="display:block;overflow-x:hidden;overflow-y:scroll;height: 400px">
                                            <table class="table table-striped table-bordered table-full-width">
                                                <thead>
                                                    <tr>
                                                        <th>KATEGORI DIKLAT</th>
                                                        <th>PROVINSI</th>
                                                        <th>KABUPATEN/KOTA</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbl_wilayah">
                                                    <tr>
                                                        <td rowspan="23">KESELAMATAN</td>
                                                    </tr>
                                                    <tr>
                                                        <td>ACEH</td>
                                                        <td>-ACEH BESAR<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>SUMATERA UTARA</td>
                                                        <td>-KOTA MEDAN<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>SUMATERA BARAT</td>
                                                        <td>-PESISIR SELATAN<br>-PADANG PARIAMAN<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>LAMPUNG</td>
                                                        <td>-PRINGSEWU<br>-KOTA BANDAR LAMPUNG<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>KEPULAUAN RIAU</td>
                                                        <td>-NATUNA<br>-KOTA TANJUNG PINANG<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>JAWA BARAT</td>
                                                        <td>-GARUT<br>-TASIKMALAYA<br>-CIAMIS<br>-CIREBON<br>-INDRAMAYU<br>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>JAWA TENGAH</td>
                                                        <td>-JEPARA<br>-KOTA SURAKARTA<br>-KOTA SEMARANG<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>JAWA TIMUR</td>
                                                        <td>-PACITAN<br>-TULUNGAGUNG<br>-BLITAR<br>-BANYUWANGI<br>-KOTA
                                                            MADIUN<br>-KOTA SURABAYA<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>BALI</td>
                                                        <td>-GIANYAR<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>NUSA TENGGARA BARAT</td>
                                                        <td>-SUMBAWA<br>-SUMBAWA BARAT<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>NUSA TENGGARA TIMUR</td>
                                                        <td>-BELU<br>-LEMBATA<br>-ENDE<br>-MANGGARAI<br>-MANGGARAI
                                                            BARAT<br>-KOTA KUPANG<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>KALIMANTAN SELATAN</td>
                                                        <td>-KOTABARU<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>KALIMANTAN TIMUR</td>
                                                        <td>-KOTA BALIKPAPAN<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>KALIMANTAN UTARA</td>
                                                        <td>-KOTA TARAKAN<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>SULAWESI UTARA</td>
                                                        <td>-MINAHASA SELATAN<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>SULAWESI TENGAH</td>
                                                        <td>-TOLI-TOLI<br>-TOJO UNA-UNA<br>-KOTA PALU<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>SULAWESI SELATAN</td>
                                                        <td>-SELAYAR<br>-PANGKAJENE
                                                            KEPULAUAN<br>-BARRU<br>-BONE<br>-PINRANG<br>-LUWU
                                                            TIMUR<br>-KOTA MAKASSAR<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>SULAWESI TENGGARA</td>
                                                        <td>-BUTON<br>-MUNA<br>-KOLAKA<br>-KOTA KENDARI<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>SULAWESI BARAT</td>
                                                        <td>-MAMUJU<br>-POLEWALI MANDAR<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>MALUKU UTARA</td>
                                                        <td>-KOTA TERNATE<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>PAPUA BARAT</td>
                                                        <td>-KOTA SORONG<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>PAPUA</td>
                                                        <td>-KOTA JAYAPURA<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td rowspan="3">COMMUNITY DEVELOPMENT</td>
                                                    </tr>
                                                    <tr>
                                                        <td>SUMATERA SELATAN</td>
                                                        <td>-BANYUASIN<br>-KOTA PALEMBANG<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td rowspan="8">REVITALISASI SMK</td>
                                                    </tr>
                                                    <tr>
                                                        <td>RIAU</td>
                                                        <td>-KAMPAR<br>-KEP. MERANTI<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>JAMBI</td>
                                                        <td>-KOTA JAMBI<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>KEP. BANGKA BELITUNG</td>
                                                        <td>-BELITUNG<br>-BANGKA TENGAH<br>-KOTA PANGKAL PINANG<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>DKI JAKARTA</td>
                                                        <td>-KOTA JAKARTA TIMUR<br>-KOTA JAKARTA UTARA<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>BANTEN</td>
                                                        <td>-PANDEGLANG<br>-TANGERANG<br>-SERANG<br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>KALIMANTAN BARAT</td>
                                                        <td>-MEMPAWAH<br>-KETAPANG<br>-KUBU RAYA<br>-KOTA
                                                            PONTIANAK<br>-KOTA SINGKAWANG<br></td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="border: 1px solid black;">
                                    <div class="col-md-12">
                                        <h3 class="text-center mt-2">Pelacakan Input Data DPM</h3>
                                        <table class="table table-bordered table-full-width">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>UPT</th>
                                                    <th>TANGGAL INPUT TERAKHIR</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="background-color: #f75252">

                                                    <td>1</td>
                                                    <td>PKTJ - TEGAL</td>
                                                    <td>28 Jan 2020</td>
                                                </tr>
                                                <tr style="background-color: #f75252">

                                                    <td>2</td>
                                                    <td>PPI - MADIUN</td>
                                                    <td>23 Mar 2020</td>
                                                </tr>
                                                <tr style="background-color: #f75252">

                                                    <td>3</td>
                                                    <td>POLTRADA - BALI</td>
                                                    <td>31 Mar 2020</td>
                                                </tr>
                                                <tr style="background-color: #f75252">

                                                    <td>4</td>
                                                    <td>POLTEKPEL - BAROMBONG</td>
                                                    <td>02 Apr 2020</td>
                                                </tr>
                                                <tr style="background-color: #f75252">

                                                    <td>5</td>
                                                    <td>PIP - MAKASSAR</td>
                                                    <td>02 Apr 2020</td>
                                                </tr>
                                                <tr style="background-color: #f75252">

                                                    <td>6</td>
                                                    <td>POLTEKPEL - MALAHAYATI</td>
                                                    <td>09 Apr 2020</td>
                                                </tr>
                                                <tr style="background-color: #f75252">

                                                    <td>7</td>
                                                    <td>POLTEKPEL - SUMATERA BARAT</td>
                                                    <td>17 Apr 2020</td>
                                                </tr>
                                                <tr style="background-color: #f75252">

                                                    <td>8</td>
                                                    <td>POLTEKBANG - PALEMBANG</td>
                                                    <td>19 Apr 2020</td>
                                                </tr>
                                                <tr style="background-color: #f75252">

                                                    <td>9</td>
                                                    <td>BP2TD - MEMPAWAH</td>
                                                    <td>01 May 2020</td>
                                                </tr>
                                                <tr style="background-color: #f75252">

                                                    <td>10</td>
                                                    <td>POLTEKBANG - SURABAYA</td>
                                                    <td>06 May 2020</td>
                                                </tr>
                                                <tr style="background-color: #f75252">

                                                    <td>11</td>
                                                    <td>POLTEKTRANS SDP - PALEMBANG</td>
                                                    <td>18 May 2020</td>
                                                </tr>
                                                <tr style="background-color: #f75252">

                                                    <td>12</td>
                                                    <td>PPI - CURUG</td>
                                                    <td>18 May 2020</td>
                                                </tr>
                                                <tr style="background-color: #f75252">

                                                    <td>13</td>
                                                    <td>POLTEKPEL - SORONG</td>
                                                    <td>27 May 2020</td>
                                                </tr>
                                                <tr style="background-color: #fbfb69">

                                                    <td>14</td>
                                                    <td>BP3 - CURUG</td>
                                                    <td>02 Jun 2020</td>
                                                </tr>
                                                <tr style="background-color: #fbfb69">

                                                    <td>15</td>
                                                    <td>PTDI - STTD</td>
                                                    <td>05 Jun 2020</td>
                                                </tr>
                                                <tr style="background-color: #fbfb69">

                                                    <td>16</td>
                                                    <td>POLTEKPEL - SURABAYA</td>
                                                    <td>11 Jun 2020</td>
                                                </tr>
                                                <tr style="background-color: #fbfb69">

                                                    <td>17</td>
                                                    <td>API - BANYUWANGI</td>
                                                    <td>11 Jun 2020</td>
                                                </tr>
                                                <tr style="background-color: #fbfb69">

                                                    <td>18</td>
                                                    <td>POLTEKPEL - SULAWESI UTARA</td>
                                                    <td>12 Jun 2020</td>
                                                </tr>
                                                <tr style="background-color: #fbfb69">

                                                    <td>19</td>
                                                    <td>POLTEKBANG - MAKASSAR</td>
                                                    <td>12 Jun 2020</td>
                                                </tr>
                                                <tr style="background-color: #fbfb69">

                                                    <td>20</td>
                                                    <td>STIP - JAKARTA</td>
                                                    <td>16 Jun 2020</td>
                                                </tr>
                                                <tr style="background-color: #fbfb69">

                                                    <td>21</td>
                                                    <td>POLTEKPEL - BANTEN</td>
                                                    <td>16 Jun 2020</td>
                                                </tr>
                                                <tr style="background-color: #fbfb69">

                                                    <td>22</td>
                                                    <td>POLTEKBANG - JAYAPURA</td>
                                                    <td>16 Jun 2020</td>
                                                </tr>
                                                <tr>

                                                    <td>23</td>
                                                    <td>POLTEKBANG - MEDAN</td>
                                                    <td>17 Jun 2020</td>
                                                </tr>
                                                <tr>

                                                    <td>24</td>
                                                    <td>BP2TL - JAKARTA</td>
                                                    <td>18 Jun 2020</td>
                                                </tr>
                                                <tr>

                                                    <td>25</td>
                                                    <td>PIP - SEMARANG</td>
                                                    <td>24 Jun 2020</td>
                                                </tr>

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content clearfix" id="tab-responsive-2">
                                Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.
                            </div>
                            <div class="tab-content clearfix" id="tab-responsive-3">
                                <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
                                Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.
                            </div>
                            <div class="tab-content clearfix" id="tab-responsive-4">
                                Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.
                            </div>

                        </div>

                    </div>






                </div>
            </div>

            <!-- Post Content
					============================================= -->
            <!-- .postcontent end -->

            <!-- Sidebar
					============================================= -->


        </div>

    </div>

</section>
@endsection