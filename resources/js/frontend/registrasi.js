$(function () {
    if ($("#no_hp").length > 0) {
        $("#no_hp").mask("62800000000000");
    }

    const dataLevel = {
        PRACADET: "PRACADET",
        CADET: "CADET",
        JUNIOR: "JUNIOR",
        SENIOR: "SENIOR",
    };

    const dataLevelPemula = {
        "PRACADET_4-5": "PRACADET 4-5",
        "PRACADET_6-7": "PRACADET 6-7",
        "PRACADET_8-9": "PRACADET 8-9",
        "PRACADET_10-11": "PRACADET 10-11",
        CADET: "CADET",
        JUNIOR: "JUNIOR",
        SENIOR: "SENIOR",
    };
    const dataKategoriTanding = { POOMSAE: "POOMSAE", KYORUGI: "KYORUGI" };

    const prestasiPoomSae = {
        "Individu-Putra": "Individu Putra",
        "Individu-Putri": "Individu Putri",
        Pair: "Pair",
        Beregu: "Beregu",
        Freestyle: "Freestlye",
    };

    const pemulaPoomSaeGroup1 = {
        "Individu-Putra": "Individu Putra",
        "Individu-Putri": "Individu Putri",
    };

    // const pemulaPoomSaeGroup2 = {
    //     "KUNING/KUNING-STRIP": "KUNING/KUNING STRIP",
    //     "HIJAU/HIJAU-STRIP": "HIJAU/HIJAU STRIP",
    //     "BIRU/MERAH": "BIRU/MERAH",
    // };

    const pemulaPoomSaeGroup2 = {
        PUTIH: "PUTIH",
        KUNING: "KUNING",
        "KUNING-STRIP": "KUNING-STRIP",
        HIJAU: "HIJAU",
        "HIJAU-STRIP": "HIJAU-STRIP",
        BIRU: "BIRU",
        "BIRU-STRIP": "BIRU-STRIP",
        MERAH: "MERAH",
    };

    const pemulaKyorugiUsiaPraCadet = {
        "4-5th": "4-5th",
        "6-7th": "6-7th",
        "8-9th": "8-9th",
        "10-11th": "10-11th",
    };

    const pracadetPrestasiBeratBadan = {
        Putra: {
            "U.22 KG": "U.22 KG",
            "U.24 KG": "U.24 KG",
            "U.26 KG": "U.26 KG",
            "U.28 KG": "U.28 KG",
            "U.31 KG": "U.31 KG",
            "U.34 KG": "U.34 KG",
            "U.37 KG": "U.37 KG",
            "U.41 KG": "U.41 KG",
            "U.45 KG": "U.45 KG",
            "O.45 KG": "O.45 KG",
        },
        Putri: {
            "U.22 KG": "U.22 KG",
            "U.24 KG": "U.24 KG",
            "U.26 KG": "U.26 KG",
            "U.28 KG": "U.28 KG",
            "U.31 KG": "U.31 KG",
            "U.34 KG": "U.34 KG",
            "U.37 KG": "U.37 KG",
            "U.41 KG": "U.41 KG",
            "U.45 KG": "U.45 KG",
            "O.45 KG": "O.45 KG",
        },
    };

    const pracadetBeratBadan = {
        "PRACADET_4-5": {
            Putra: {
                "U.18 KG": "U.18 KG",
                "U.20 KG": "U.20 KG",
                "U.23 KG": "U.23 KG",
                "U.26 KG": "U.26 KG",
                "U.29 KG": "U.29 KG",
                "U.33 KG": "U.33 KG",
                "U.37 KG": "U.37 KG",
                "U.37,1 KG": "U.37,1 KG",
            },

            Putri: {
                "U.16 KG": "U.16 KG",
                "U.18 KG": "U.18 KG",
                "U.21 KG": "U.21 KG",
                "U.24 KG": "U.24 KG",
                "U.27 KG": "U.27 KG",
                "U.31 KG": "U.31 KG",
                "U.35 KG": "U.35 KG",
                "U.35,1 KG": "U.35,1 KG",
            },
        },

        "PRACADET_6-7": {
            Putra: {
                "U.18 KG": "U.18 KG",
                "U.20 KG": "U.20 KG",
                "U.23 KG": "U.23 KG",
                "U.26 KG": "U.26 KG",
                "U.29 KG": "U.29 KG",
                "U.33 KG": "U.33 KG",
                "U.37 KG": "U.37 KG",
                "U.37,1 KG": "U.37,1 KG",
            },

            Putri: {
                "U.16 KG": "U.16 KG",
                "U.18 KG": "U.18 KG",
                "U.21 KG": "U.21 KG",
                "U.24 KG": "U.24 KG",
                "U.27 KG": "U.27 KG",
                "U.31 KG": "U.31 KG",
                "U.35 KG": "U.35 KG",
                "U.35,1 KG": "U.35,1 KG",
            },
        },

        "PRACADET_8-9": {
            Putra: {
                "U.20 KG": "U.20 KG",
                "U.22 KG": "U.22 KG",
                "U.24 KG": "U.24 KG",
                "U.26 KG": "U.26 KG",
                "U.28 KG": "U.28 KG",
                "U.30 KG": "U.30 KG",
                "U.32 KG": "U.32 KG",
                "U.34 KG": "U.34 KG",
                "U.36 KG": "U.36 KG",
                "O.36,1 KG": "O.36,1 KG",
            },

            Putri: {
                "U.18 KG": "U.18 KG",
                "U.20 KG": "U.20 KG",
                "U.22 KG": "U.22 KG",
                "U.24 KG": "U.24 KG",
                "U.26 KG": "U.26 KG",
                "U.28 KG": "U.28 KG",
                "U.30 KG": "U.30 KG",
                "U.32 KG": "U.32 KG",
                "U.34 KG": "U.34 KG",
                "O.34,1 KG": "O.34,1 KG",
            },
        },

        "PRACADET_10-11": {
            Putra: {
                "U.24 KG": "U.24 KG",
                "U.26 KG": "U.26 KG",
                "U.28 KG": "U.28 KG",
                "U.30 KG": "U.30 KG",
                "U.32 KG": "U.32 KG",
                "U.34 KG": "U.34 KG",
                "U.36 KG": "U.36 KG",
                "U.38 KG": "U.38 KG",
                "U.40 KG": "U.40 KG",
                "O.40,1 KG": "O.40,1 KG",
            },

            Putri: {
                "U.22 KG": "U.22 KG",
                "U.24 KG": "U.24 KG",
                "U.26 KG": "U.26 KG",
                "U.28 KG": "U.28 KG",
                "U.30 KG": "U.30 KG",
                "U.32 KG": "U.32 KG",
                "U.34 KG": "U.34 KG",
                "U.36 KG": "U.36 KG",
                "U.38 KG": "U.38 KG",
                "O.38,1 KG": "O.38,1 KG",
            },
        },
    };

    const cadetBeratBadan = {
        Putra: {
            "U.33 KG": "U.33 KG",
            "U.37 KG": "U.37 KG",
            "U.41 KG": "U.41 KG",
            "U.45 KG": "U.45 KG",
            "U.49 KG": "U.49 KG",
            "U.53 KG": "U.53 KG",
            "U.57 KG": "U.57 KG",
            "U.61 KG": "U.61 KG",
            "U.65 KG": "U.65 KG",
            "O.65 KG": "O.65 KG",
        },
        Putri: {
            "U.29 KG": "U.29 KG",
            "U.32 KG": "U.32 KG",
            "U.36 KG": "U.36 KG",
            "U.40 KG": "U.40 KG",
            "U.44 KG": "U.44 KG",
            "U.47 KG": "U.47 KG",
            "U.51 KG": "U.51 KG",
            "U.55 KG": "U.55 KG",
            "U.59 KG": "U.59 KG",
            "O.59 KG": "O.59 KG",
        },
    };

    const juniorBeratBadan = {
        Putra: {
            "U.45 KG": "U.45 KG",
            "U.48 KG": "U.48 KG",
            "U.51 KG": "U.51 KG",
            "U.55 KG": "U.55 KG",
            "U.59 KG": "U.59 KG",
            "U.63 KG": "U.63 KG",
            "U.68 KG": "U.68 KG",
            "U.73 KG": "U.73 KG",
            "U.78 KG": "U.78 KG",
            "O.78 KG": "O.78 KG",
        },
        Putri: {
            "U.42 KG": "U.42 KG",
            "U.44 KG": "U.44 KG",
            "U.46 KG": "U.46 KG",
            "U.49 KG": "U.49 KG",
            "U.52 KG": "U.52 KG",
            "U.55 KG": "U.55 KG",
            "U.59 KG": "U.59 KG",
            "U.63 KG": "U.63 KG",
            "U.68 KG": "U.68 KG",
            "O.68 KG": "O.68 KG",
        },
    };

    const seniorBeratBadan = {
        Putra: {
            "U.54 KG": "U.54 KG",
            "U.58 KG": "U.58 KG",
            "U.63 KG": "U.63 KG",
            "U.68 KG": "U.68 KG",
            "U.74 KG": "U.74 KG",
            "U.80 KG": "U.80 KG",
            "U.87 KG": "U.87 KG",
            "O.87 KG": "O.87 KG",
        },
        Putri: {
            "U.46 KG": "U.46 KG",
            "U.49 KG": "U.49 KG",
            "U.53 KG": "U.53 KG",
            "U.57 KG": "U.57 KG",
            "U.62 KG": "U.62 KG",
            "U.67 KG": "U.67 KG",
            "U.73 KG": "U.73 KG",
            "O.73 KG": "O.73 KG",
        },
    };

    $(
        "#kategori, #kategori_level, #kategori_tanding, #kelompok_poomsae, #sabuk_poomsae, #berat_badan",
    ).select2();

    $("#kategori").on("change", function () {
        $("#sectionPoomSae").addClass("d-none");
        $("#sectionKyorugi").addClass("d-none");

        $("#kategori_level, #kategori_tanding").empty();
        $("#kategori_level, #kategori_tanding").prepend(
            `<option value="" selected>Pilih</option>`,
        );

        if ($(this).val() == "Pemula") {
            //Pemula
            $.each(dataLevelPemula, function (index, value) {
                $("#kategori_level").append(
                    `<option value=${index} >${value}</option>`,
                );
            });
        } else if ($(this).val() == "Prestasi") {
            //Prestasi
            $.each(dataLevel, function (index, value) {
                $("#kategori_level").append(
                    `<option value=${index} >${value}</option>`,
                );
            });
        }
    });

    $("#kategori_level").on("change", function () {
        $("#kategori_tanding").empty();
        $("#kategori_tanding").prepend(
            `<option selected value="">Pilih</option>`,
        );

        $("#sectionPoomSae").addClass("d-none");
        $("#sectionKyorugi").addClass("d-none");

        $("#berat_badan")
            .empty()
            .prepend(`<option selected value="">Pilih</option>`);

        $("#tinggi_badan").val("");
        $("#kelompok_poomsae")
            .empty()
            .prepend(`<option value="" selected>Pilih</option>`);
        $("#sabuk_poomsae")
            .empty()
            .prepend(`<option value="" selected>Pilih</option>`);

        $.each(dataKategoriTanding, function (index, value) {
            $("#kategori_tanding").append(
                `<option value=${index} >${value}</option>`,
            );
        });

        if ($("#berat_badan").length > 0) {
            beratBadan();
        }
    });

    $("#gender").on("change", function () {
        if ($("#berat_badan").length > 0) {
            beratBadan();
        }
    });

    const beratBadan = () => {
        let genderIndex = $("#gender").val();

        $("#berat_badan")
            .empty()
            .prepend(`<option value="" selected>Pilih</option>`);

        //PRA CADET
        const pracadetKategoriLevels = [
            "PRACADET_4-5",
            "PRACADET_6-7",
            "PRACADET_8-9",
            "PRACADET_10-11",
        ];
        if (pracadetKategoriLevels.includes($("#kategori_level").val())) {
            if (genderIndex != "") {
                let kategoriLevel = $("#kategori_level").val();
                // console.log(pracadetBeratBadan);
                $.each(
                    pracadetBeratBadan[kategoriLevel][genderIndex],
                    function (index, value) {
                        $("#berat_badan").append(
                            `<option value=${index} >${value}</option>`,
                        );
                    },
                );
            } else {
                alert("Gender belum dipilih");
                return false;
            }
        }

        if ($("#kategori_level").val() == "PRACADET") {
            //PRACADET

            $.each(
                pracadetPrestasiBeratBadan[genderIndex],
                function (index, val) {
                    $("#berat_badan").append(
                        `<option value=${index} >${val}</option>`,
                    );
                },
            );
        }

        if ($("#kategori_level").val() == "CADET") {
            //CADET

            $.each(cadetBeratBadan[genderIndex], function (index, val) {
                $("#berat_badan").append(
                    `<option value=${index} >${val}</option>`,
                );
            });
        }

        if ($("#kategori_level").val() == "JUNIOR") {
            //JUNIOR

            $.each(juniorBeratBadan[genderIndex], function (index, val) {
                $("#berat_badan").append(
                    `<option value=${index} >${val}</option>`,
                );
            });
        }

        if ($("#kategori_level").val() == "SENIOR") {
            //SENIOR

            $.each(seniorBeratBadan[genderIndex], function (index, val) {
                $("#berat_badan").append(
                    `<option value=${index} >${val}</option>`,
                );
            });
        }
    };

    $("#kategori_tanding").on("change", function () {
        if ($(this).val() == "POOMSAE") {
            $("#sectionPoomSae").removeClass("d-none");
            $("#sectionKyorugi").addClass("d-none");
            $(".div-tinggi-badan").addClass("d-none");
            $("#tinggi_badan").val("");

            $("#sabuk_poomsae")
                .empty()
                .prepend(`<option value="" selected>Pilih</option>`);
            $("#kelompok_poomsae")
                .empty()
                .prepend(`<option value="" selected>Pilih</option>`);

            //if pemula
            if ($("#kategori").val() == "Pemula") {
                $.each(pemulaPoomSaeGroup1, function (index, value) {
                    $("#kelompok_poomsae").append(
                        `<option value=${index} >${value}</option>`,
                    );
                });

                $.each(pemulaPoomSaeGroup2, function (index, value) {
                    $("#sabuk_poomsae").append(
                        `<option value=${index} >${value}</option>`,
                    );
                });

                $(".div-sabuk-poomsae").removeClass("d-none");
            } else if ($("#kategori").val() == "Prestasi") {
                $(".div-sabuk-poomsae").addClass("d-none");

                $.each(prestasiPoomSae, function (index, value) {
                    $("#kelompok_poomsae").append(
                        `<option value=${index} >${value}</option>`,
                    );
                });
            }
        } else if ($(this).val() == "KYORUGI") {
            $("#sectionPoomSae").addClass("d-none");
            $("#sectionKyorugi").removeClass("d-none");

            if ($("#kategori").val() == "Pemula") {
                $(".div-tinggi-badan").removeClass("d-none");
            } else {
                $(".div-tinggi-badan").addClass("d-none");
                $("#tinggi_badan").val("");
            }

            beratBadan();
        }
    });

    $("#kategori_usia").on("change", function () {
        const genderIndex = $("#gender").val();
        const usiaPraCadet = $(this).val();

        $("#berat_badan")
            .empty()
            .prepend(`<option value="" selected>Pilih</option>`);

        if (genderIndex != "") {
            $.each(
                pracadetBeratBadan[usiaPraCadet][genderIndex],
                function (index, value) {
                    $("#berat_badan").append(
                        `<option value=${index} >${value}</option>`,
                    );
                },
            );
        } else {
            alert("Gender belum dipilih");
            return false;
        }
    });
});
