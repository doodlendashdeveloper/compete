<script>
    function manageUsers() {
        dataUrl = "<?= route('superadmin.users.manage') ?>";
        $.ajax({
            url: dataUrl,
            success: function (data) {
                $('#manage-users').html(data);
            }
        })
    }



    $(document).on("click", "#add-user", async function (event) {
        $("#custom-modal-title").text("Add Officer");

        var data_url = "<?= route('superadmin.users.manage.add') ?>";
        $.ajax({
            url: data_url,
            success: function (data) {
                $(".custom-modal").modal("show");
                $("#custom-modal-body").html(data);
            }
        })
    });

    $(document).on('submit', '#add-user-form', async function (e) {
        e.preventDefault();
        var submit_button_text = $("#custom-save-button").html();

        var form_data = new FormData(this);
        var form_url = "<?= route('superadmin.users.manage.save') ?>";
        const isSuccess = await saveFormDataAjax(form_data, form_url, submit_button_text);
        if (isSuccess == true) {
            manageUsers();
        }
    })

    $(document).on('change', '#c-user-toggle', async function (e) {
        e.preventDefault();
        var user_id = $(this).data('id');
        var status = $(this).prop('checked') ? 1 : 0;
        var form_url = "<?= route('superadmin.users.manage.toggle-status') ?>";
        const data_to_send = new FormData();
        data_to_send.append('id', user_id);
        data_to_send.append('status', status);
        const isSuccess = await changeStatusToggle(form_url, data_to_send);
    });


    $(document).on("click", "#edit-user", function () {
        event.preventDefault();
        var id = $(this).data("id");
        $("#custom-modal-title").text("Edit user");
        var dataUrl = `<?= route('superadmin.users.manage.edit', ['id' => '__ID__']) ?>`.replace('__ID__', id);
        $.ajax({
            url: dataUrl,
            success: function (data) {
                $(".custom-modal").modal("show");
                $("#custom-modal-body").html(data);
            }
        })
    });

    $(document).on('submit', '#edit-user-form', async function (e) {
        e.preventDefault();
        var id = $("#edit_id").val();
        var submit_button_text = $("#custom-save-button").html();
        var form_data = new FormData(this);
        var form_url = `<?= route('superadmin.users.manage.update', ['id' => '__ID__']) ?>`.replace('__ID__', id);
        const isSuccess = await saveFormDataAjax(form_data, form_url, submit_button_text);
        if (isSuccess == true) {
            manageUsers();
        }
    });

    $(document).on("click", "#trash-user", async function (event) {
        event.preventDefault();
        var id = $(this).attr("data-id");
        var data_url = `<?= route('superadmin.users.manage.delete', ['id' => '__ID__']) ?>`.replace('__ID__', id);
        try {
            let isSuccess = await deleteRecordViaAjax(data_url, '', 'GET', "You want to move it to Trash!");
            if (isSuccess === true) {
                manageUsers();
            }
        } catch (error) {
            console.error("Error deleting base:", error);
        }
    });

    function trashedUsers() {
        dataUrl = "<?= route('superadmin.users.trash.manage') ?>";
        $.ajax({
            url: dataUrl,
            success: function (data) {
                $('#trashed-users').html(data);
            }
        })
    }



    $(document).on("click", "#restore-user", async function (event) {
        event.preventDefault();
        var id = $(this).attr("data-id");
        var data_url = `<?= route('superadmin.users.trash.recover', ['id' => '__ID__']) ?>`.replace('__ID__', id);
        try {
            let isSuccess = await deleteRecordViaAjax(data_url, '', 'GET', "You want to recover it!");
            if (isSuccess === true) {
                trashedUsers();
            }
        } catch (error) {
            console.error("Error deleting base:", error);
        }
    });


    function manageForms() {
        dataUrl = "<?= route('superadmin.forms.manage') ?>";
        $.ajax({
            url: dataUrl,
            success: function (data) {
                $('#manage-forms').html(data);
            }
        })
    }

    $(document).on("click", "#add-form", async function (event) {
        $("#custom-modal-title").text("Add Form");

        var data_url = "<?= route('superadmin.forms.manage.add') ?>";
        $.ajax({
            url: data_url,
            success: function (data) {
                $(".custom-modal").modal("show");
                $("#custom-modal-body").html(data);
            }
        })
    });

    $(document).on('submit', '#add-form-form', async function (e) {
        e.preventDefault();
        var submit_button_text = $("#custom-save-button").html();

        var form_data = new FormData(this);
        var form_url = "<?= route('superadmin.forms.manage.save') ?>";
        const isSuccess = await saveFormDataAjax(form_data, form_url, submit_button_text);
        if (isSuccess == true) {
            manageForms();
        }
    })


    $(document).on('change', '#c-form-toggle', async function (e) {
        e.preventDefault();
        var user_id = $(this).data('id');
        var status = $(this).prop('checked') ? 1 : 0;
        var form_url = "<?= route('superadmin.forms.manage.toggle-status') ?>";
        const data_to_send = new FormData();
        data_to_send.append('id', user_id);
        data_to_send.append('status', status);
        const isSuccess = await changeStatusToggle(form_url, data_to_send);
    });



    $(document).on("click", "#edit-form", function () {
        event.preventDefault();
        var id = $(this).data("id");
        $("#custom-modal-title").text("Edit Form");
        var dataUrl = `<?= route('superadmin.forms.manage.edit', ['id' => '__ID__']) ?>`.replace('__ID__', id);
        $.ajax({
            url: dataUrl,
            success: function (data) {
                $(".custom-modal").modal("show");
                $("#custom-modal-body").html(data);
            }
        })
    });


    $(document).on('submit', '#edit-form-form', async function (e) {
        e.preventDefault();
        var id = $("#edit_id").val();
        var submit_button_text = $("#custom-save-button").html();
        var form_data = new FormData(this);
        var form_url = `<?= route('superadmin.forms.manage.update', ['id' => '__ID__']) ?>`.replace('__ID__', id);
        const isSuccess = await saveFormDataAjax(form_data, form_url, submit_button_text);
        if (isSuccess == true) {
            manageForms();
        }
    });


    $(document).on("click", "#delete-form", async function (event) {
        event.preventDefault();
        var id = $(this).attr("data-id");
        var data_url = `<?= route('superadmin.forms.manage.delete', ['id' => '__ID__']) ?>`.replace('__ID__', id);
        try {
            let isSuccess = await deleteRecordViaAjax(data_url);
            if (isSuccess === true) {
                manageForms();
            }
        } catch (error) {
            console.error("Error deleting base:", error);
        }
    });


    function manage_form_sections(form_id) {
        var data_url = `<?= route('superadmin.forms.section.manage', ['id' => '__ID__']) ?>`.replace('__ID__', form_id);
        $.ajax({
            url: data_url,
            success: function (data) {
                $('#manage-form-sections').html(data);
            }
        })
    }


    $(document).on("click", "#add-form-section", async function (event) {
        $("#custom-modal-title").text("Add Section");
        var form_id = $(this).data("id");
        var data_url = `<?= route('superadmin.forms.section.manage.add', ['id' => '__ID__']) ?>`.replace('__ID__', form_id);
        $.ajax({
            url: data_url,
            success: function (data) {
                $(".custom-modal").modal("show");
                $("#custom-modal-body").html(data);
            }
        })
    });


    $(document).on('submit', '#add-form-section-form', async function (e) {
        e.preventDefault();
        var submit_button_text = $("#custom-save-button").html();
        var form_id = $("#form_id").val();
        var form_data = new FormData(this);
        var form_url = `<?= route('superadmin.forms.section.manage.save', ['id' => '__ID__']) ?>`.replace('__ID__', form_id);
        const isSuccess = await saveFormDataAjax(form_data, form_url, submit_button_text);
        if (isSuccess == true) {
            manage_form_sections(form_id);
        }
    })

    $(document).on('change', '#c-form-section-toggle', async function (e) {
        e.preventDefault();
        var section_id = $(this).data('id');
        var form_id = $(this).attr('data-formId');
        var status = $(this).prop('checked') ? 1 : 0;
        var form_url = `<?= route('superadmin.forms.section.manage.toggle-status', ['id' => '__ID__']) ?>`.replace('__ID__', form_id);
        const data_to_send = new FormData();
        data_to_send.append('section_id', section_id);
        data_to_send.append('status', status);
        const isSuccess = await changeStatusToggle(form_url, data_to_send);
    });

    $(document).on("click", "#edit-form-section", function () {
        event.preventDefault();
        var id = $(this).data("id");
        var form_id = $(this).attr('data-formId');
        $("#custom-modal-title").text("Edit Section");
        var dataUrl = `<?= route('superadmin.forms.section.manage.edit', ['id' => '__FORM_ID__', 'section_id' => '__ID__']) ?>`
            .replace('__ID__', id)
            .replace('__FORM_ID__', form_id);
        $.ajax({
            url: dataUrl,
            success: function (data) {
                $(".custom-modal").modal("show");
                $("#custom-modal-body").html(data);
            }
        })
    });


    $(document).on('submit', '#edit-form-section-form', async function (e) {
        e.preventDefault();
        var form_id = $("#form_id").val();
        var section_id = $("#section_id").val();
        var submit_button_text = $("#custom-save-button").html();
        var form_data = new FormData(this);

        var form_url = `<?= route('superadmin.forms.section.manage.update', ['id' => '__FORM_ID__', 'section_id' => '__ID__']) ?>`
            .replace('__ID__', section_id)
            .replace('__FORM_ID__', form_id);
        const isSuccess = await saveFormDataAjax(form_data, form_url, submit_button_text);
        if (isSuccess == true) {
            manage_form_sections(form_id);
        }
    });

    $(document).on("click", "#delete-form-section", async function (event) {
        event.preventDefault();
        var id = $(this).data("id");
        var form_id = $(this).attr('data-formId');
        var data_url = `<?= route('superadmin.forms.section.manage.delete', ['id' => '__FORM_ID__', 'section_id' => '__ID__']) ?>`
            .replace('__ID__', id)
            .replace('__FORM_ID__', form_id);
        try {
            let isSuccess = await deleteRecordViaAjax(data_url);
            if (isSuccess === true) {
                manage_form_sections(form_id);
            }
        } catch (error) {
            console.error("Error deleting base:", error);
        }
    });


    function manage_form_section_questions(form_id, section_id) {
        var data_url = `<?= route('superadmin.form.section.view.manage', ['id' => '__FORM_ID__', 'section_id' => '__ID__']) ?>`
            .replace('__ID__', section_id)
            .replace('__FORM_ID__', form_id);
        $.ajax({
            url: data_url,
            success: function (data) {
                $('#manage-form-sections-qns').html(data);
            }
        })
    }

    $(document).on("click", "#add-form-section-questions", async function (event) {
        $("#custom-modal-title").text("Add Question");
        var section_id = $(this).data("id");
        var form_id = $(this).attr('data-formId');
        var data_url = `<?= route('superadmin.form.section.view.manage.add', ['id' => '__FORM_ID__', 'section_id' => '__ID__']) ?>`
            .replace('__ID__', section_id)
            .replace('__FORM_ID__', form_id);
        $.ajax({
            url: data_url,
            success: function (data) {
                $(".custom-modal").modal("show");
                $("#custom-modal-body").html(data);
            }
        })
    });


    $(document).on('submit', '#add-question-form', async function (e) {

        e.preventDefault();
        var submit_button_text = $("#custom-save-button").html();
        var form_id = $("#form_id").val();
        var section_id = $("#section_id").val();
        var form_data = new FormData(this);
        var form_url = `<?= route('superadmin.form.section.view.manage.save', ['id' => '__FORM_ID__', 'section_id' => '__ID__']) ?>`
            .replace('__ID__', section_id)
            .replace('__FORM_ID__', form_id);
        const isSuccess = await saveFormDataAjax(form_data, form_url, submit_button_text);
        if (isSuccess == true) {
            manage_form_section_questions(form_id, section_id);
        }
    })


    $(document).on('change', '#c-form-question-toggle', async function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var form_id = $(this).attr('data-formId');
        var section_id = $(this).attr('data-sectionId');
        var status = $(this).prop('checked') ? 1 : 0;
        var form_url = `<?= route('superadmin.form.section.view.manage.toggle-status', ['id' => '__FORM_ID__', 'section_id' => '__ID__']) ?>`
            .replace('__ID__', section_id)
            .replace('__FORM_ID__', form_id);
        const data_to_send = new FormData();
        data_to_send.append('question_id', id);
        data_to_send.append('status', status);
        const isSuccess = await changeStatusToggle(form_url, data_to_send);
    });


    $(document).on("click", "#edit-question", function () {
        event.preventDefault();

        var question_id = $(this).data('id');
        var form_id = $(this).attr('data-formId');
        var section_id = $(this).attr('data-sectionId');
        $("#custom-modal-title").text("Edit Question");
        var dataUrl = `<?= route('superadmin.form.section.view.manage.edit', ['id' => '__FORM_ID__', 'section_id' => '__SECTION_ID__', 'question_id' => '__QUESTION_ID__']) ?>`
            .replace('__QUESTION_ID__', question_id)
            .replace('__SECTION_ID__', section_id)
            .replace('__FORM_ID__', form_id);
        $.ajax({
            url: dataUrl,
            success: function (data) {
                $(".custom-modal").modal("show");
                $("#custom-modal-body").html(data);
            }
        })
    });

    $(document).on('submit', '#edit-question-form', async function (e) {
        e.preventDefault();
        var form_id = $("#form_id").val();
        var section_id = $("#section_id").val();
        var question_id = $("#question_id").val();
        var submit_button_text = $("#custom-save-button").html();
        var form_data = new FormData(this);
        var form_url = `<?= route('superadmin.form.section.view.manage.update', ['id' => '__FORM_ID__', 'section_id' => '__SECTION_ID__', 'question_id' => '__QUESTION_ID__']) ?>`
            .replace('__QUESTION_ID__', question_id)
            .replace('__SECTION_ID__', section_id)
            .replace('__FORM_ID__', form_id);

        const isSuccess = await saveFormDataAjax(form_data, form_url, submit_button_text);
        if (isSuccess == true) {
            manage_form_section_questions(form_id, section_id);
        }
    });

    $(document).on("click", "#delete-question", async function (event) {
        event.preventDefault();
        var question_id = $(this).data("id");
        var form_id = $(this).attr('data-formId');
        var section_id = $(this).attr('data-sectionId');
        var form_url = `<?= route('superadmin.form.section.view.manage.delete', ['id' => '__FORM_ID__', 'section_id' => '__SECTION_ID__', 'question_id' => '__QUESTION_ID__']) ?>`
            .replace('__QUESTION_ID__', question_id)
            .replace('__SECTION_ID__', section_id)
            .replace('__FORM_ID__', form_id);
        try {
            let isSuccess = await deleteRecordViaAjax(form_url);
            if (isSuccess === true) {
                manage_form_section_questions(form_id, section_id);
            }
        } catch (error) {
            console.error("Error deleting base:", error);
        }
    });

    function manage_sub_section(form_id, section_id, question_id) {
        var form_url = `<?= route('superadmin.form.section.question.view.manage', ['id' => '__FORM_ID__', 'section_id' => '__SECTION_ID__', 'question_id' => '__QUESTION_ID__']) ?>`
            .replace('__QUESTION_ID__', question_id)
            .replace('__SECTION_ID__', section_id)
            .replace('__FORM_ID__', form_id);
        $.ajax({
            url: form_url,
            success: function (data) {
                $('#manage-sub-qns').html(data);
            }
        })
    }


    $(document).on("click", "#add-sub-question", async function (event) {
        $("#custom-modal-title").text("Add Sub Question");
        var question_id = $(this).data("id");
        var form_id = $(this).attr('data-formId');
        var section_id = $(this).attr('data-sectionId');
        var data_url = `<?= route('superadmin.form.section.question.view.add', ['id' => '__FORM_ID__', 'section_id' => '__SECTION_ID__', 'question_id' => '__QUESTION_ID__']) ?>`
            .replace('__QUESTION_ID__', question_id)
            .replace('__SECTION_ID__', section_id)
            .replace('__FORM_ID__', form_id);

        $.ajax({
            url: data_url,
            success: function (data) {
                $(".custom-modal").modal("show");
                $("#custom-modal-body").html(data);
            }
        })
    });

    $(document).on('submit', '#add-sub-question-form', async function (e) {
        e.preventDefault();
        var submit_button_text = $("#custom-save-button").html();
        var form_id = $("#form_id").val();
        var section_id = $("#section_id").val();
        var question_id = $("#question_id").val();
        var form_data = new FormData(this);
        var form_url = `<?= route('superadmin.form.section.question.view.save', ['id' => '__FORM_ID__', 'section_id' => '__SECTION_ID__', 'question_id' => '__QUESTION_ID__']) ?>`
            .replace('__QUESTION_ID__', question_id)
            .replace('__SECTION_ID__', section_id)
            .replace('__FORM_ID__', form_id);

        const isSuccess = await saveFormDataAjax(form_data, form_url, submit_button_text);
        if (isSuccess == true) {
            manage_sub_section(form_id, section_id, question_id);
        }
    })



    $(document).on('change', '#c-form-sub-question-toggle', async function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var form_id = $(this).attr('data-formId');
        var section_id = $(this).attr('data-sectionId');
        var question_id = $(this).attr('data-questionId');
        var status = $(this).prop('checked') ? 1 : 0;
        var form_url = `<?= route('superadmin.form.section.question.toggle-status', ['id' => '__FORM_ID__', 'section_id' => '__SECTION_ID__', 'question_id' => '__QUESTION_ID__']) ?>`
            .replace('__QUESTION_ID__', question_id)
            .replace('__SECTION_ID__', section_id)
            .replace('__FORM_ID__', form_id);
        const data_to_send = new FormData();
        data_to_send.append('question_id', id);
        data_to_send.append('status', status);
        const isSuccess = await changeStatusToggle(form_url, data_to_send);
    });


    $(document).on("click", "#edit-sub-question", function () {
        event.preventDefault();

        var sub_question_id = $(this).data('id');
        var form_id = $(this).attr('data-formId');
        var section_id = $(this).attr('data-sectionId');
        var question_id = $(this).attr('data-questionId');
        $("#custom-modal-title").text("Edit Sub Question");
        var dataUrl = `<?= route('superadmin.form.section.question.manage.edit', ['id' => '__FORM_ID__', 'section_id' => '__SECTION_ID__', 'question_id' => '__QUESTION_ID__', 'sub_question_id' => '__SUB_QUESTION_ID__']) ?>`
            .replace('__QUESTION_ID__', question_id)
            .replace('__SECTION_ID__', section_id)
            .replace('__FORM_ID__', form_id)
            .replace('__SUB_QUESTION_ID__', sub_question_id);
        $.ajax({
            url: dataUrl,
            success: function (data) {
                $(".custom-modal").modal("show");
                $("#custom-modal-body").html(data);
            }
        })
    });




    $(document).on('submit', '#edit-sub-question-form', async function (e) {
        e.preventDefault();
        var form_id = $("#form_id").val();
        var section_id = $("#section_id").val();
        var question_id = $("#question_id").val();
        var sub_question_id = $("#sub_question_id").val();
        var submit_button_text = $("#custom-save-button").html();
        var form_data = new FormData(this);
        var form_url = `<?= route('superadmin.form.section.question.manage.edit.update', ['id' => '__FORM_ID__', 'section_id' => '__SECTION_ID__', 'question_id' => '__QUESTION_ID__', 'sub_question_id' => '__SUB_QUESTION_ID__']) ?>`
            .replace('__QUESTION_ID__', question_id)
            .replace('__SECTION_ID__', section_id)
            .replace('__FORM_ID__', form_id)
            .replace('__SUB_QUESTION_ID__', sub_question_id);


        const isSuccess = await saveFormDataAjax(form_data, form_url, submit_button_text);
        if (isSuccess == true) {
            manage_sub_section(form_id, section_id, question_id);
        }
    });

    $(document).on("click", "#delete-sub-question", async function (event) {
        event.preventDefault();
        var sub_question_id = $(this).data('id');
        var form_id = $(this).attr('data-formId');
        var section_id = $(this).attr('data-sectionId');
        var question_id = $(this).attr('data-questionId');
        var form_url = `<?= route('superadmin.form.section.question.manage.edit.delete', ['id' => '__FORM_ID__', 'section_id' => '__SECTION_ID__', 'question_id' => '__QUESTION_ID__', 'sub_question_id' => '__SUB_QUESTION_ID__']) ?>`
            .replace('__QUESTION_ID__', question_id)
            .replace('__SECTION_ID__', section_id)
            .replace('__FORM_ID__', form_id)
            .replace('__SUB_QUESTION_ID__', sub_question_id);
        try {
            let isSuccess = await deleteRecordViaAjax(form_url);
            if (isSuccess === true) {
                manage_sub_section(form_id, section_id, question_id);
            }
        } catch (error) {
            console.error("Error deleting base:", error);
        }
    });



    function manage_sub_question_level2(form_id, section_id, question_id, sub_question_id) {
        var form_url = `<?= route('superadmin.form.section.question.sub_question.view.manage', ['id' => '__FORM_ID__', 'section_id' => '__SECTION_ID__', 'question_id' => '__QUESTION_ID__', 'sub_question_id' => '__SUB_QUESTION_ID__']) ?>`
            .replace('__QUESTION_ID__', question_id)
            .replace('__SECTION_ID__', section_id)
            .replace('__FORM_ID__', form_id)
            .replace('__SUB_QUESTION_ID__', sub_question_id);
        $.ajax({
            url: form_url,
            success: function (data) {
                $('#manage-sub-qns_level2').html(data);
            }
        })
    }


    $(document).on("click", "#add-sub-question-level2", async function (event) {
        $("#custom-modal-title").text("Add Sub Question");
        var sub_question_id = $(this).data("id");
        var question_id = $(this).attr('data-questionId');
        var form_id = $(this).attr('data-formId');
        var section_id = $(this).attr('data-sectionId');
        var data_url = `<?= route('superadmin.form.section.question.sub_question.view.add', ['id' => '__FORM_ID__', 'section_id' => '__SECTION_ID__', 'question_id' => '__QUESTION_ID__', 'sub_question_id' => '__SUB_QUESTION_ID__']) ?>`
            .replace('__QUESTION_ID__', question_id)
            .replace('__SECTION_ID__', section_id)
            .replace('__FORM_ID__', form_id)
            .replace('__SUB_QUESTION_ID__', sub_question_id);

        $.ajax({
            url: data_url,
            success: function (data) {
                $(".custom-modal").modal("show");
                $("#custom-modal-body").html(data);
            }
        })
    });


    $(document).on('submit', '#add-sub-question-level2-form', async function (e) {
        e.preventDefault();
        var submit_button_text = $("#custom-save-button").html();
        var form_id = $("#form_id").val();
        var section_id = $("#section_id").val();
        var question_id = $("#question_id").val();
        var sub_question_id = $("#sub_question_id").val();
        var form_data = new FormData(this);
        var form_url = `<?= route('superadmin.form.section.question.sub_question.view.add', ['id' => '__FORM_ID__', 'section_id' => '__SECTION_ID__', 'question_id' => '__QUESTION_ID__', 'sub_question_id' => '__SUB_QUESTION_ID__']) ?>`
            .replace('__QUESTION_ID__', question_id)
            .replace('__SECTION_ID__', section_id)
            .replace('__FORM_ID__', form_id)
            .replace('__SUB_QUESTION_ID__', sub_question_id);

        const isSuccess = await saveFormDataAjax(form_data, form_url, submit_button_text);
        if (isSuccess == true) {
            manage_sub_question_level2(form_id, section_id, question_id, sub_question_id);
        }
    })


    $(document).on('change', '#c-form-sub-question-level2-toggle', async function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var form_id = $(this).attr('data-formId');
        var section_id = $(this).attr('data-sectionId');
        var question_id = $(this).attr('data-questionId');
        var sub_question_id = $(this).attr('data-subQuestionId');
        var status = $(this).prop('checked') ? 1 : 0;
        var form_url = `<?= route('superadmin.form.section.question.sub_question.view.toggle-status', ['id' => '__FORM_ID__', 'section_id' => '__SECTION_ID__', 'question_id' => '__QUESTION_ID__', 'sub_question_id' => '__SUB_QUESTION_ID__']) ?>`
            .replace('__QUESTION_ID__', question_id)
            .replace('__SECTION_ID__', section_id)
            .replace('__FORM_ID__', form_id)
            .replace('__SUB_QUESTION_ID__', sub_question_id);
        const data_to_send = new FormData();
        data_to_send.append('question_id', id);
        data_to_send.append('status', status);
        const isSuccess = await changeStatusToggle(form_url, data_to_send);
    });


    $(document).on("click", "#edit-sub-question-level2", function () {
        event.preventDefault();

        var sub_question_id_level2 = $(this).data('id');
        var form_id = $(this).attr('data-formId');
        var section_id = $(this).attr('data-sectionId');
        var question_id = $(this).attr('data-questionId');
        var sub_question_id = $(this).attr('data-subQuestionId');
        $("#custom-modal-title").text("Edit Sub Question");
        var form_url = `<?= route('superadmin.form.section.question.sub_question.view.manage.edit', ['id' => '__FORM_ID__', 'section_id' => '__SECTION_ID__', 'question_id' => '__QUESTION_ID__', 'sub_question_id' => '__SUB_QUESTION_ID__', 'sub_question_id_level2' => "__ID__"]) ?>`
            .replace('__QUESTION_ID__', question_id)
            .replace('__SECTION_ID__', section_id)
            .replace('__FORM_ID__', form_id)
            .replace('__ID__', sub_question_id_level2)
            .replace('__SUB_QUESTION_ID__', sub_question_id);
        $.ajax({
            url: form_url,
            success: function (data) {
                $(".custom-modal").modal("show");
                $("#custom-modal-body").html(data);
            }
        })
    });


    $(document).on('submit', '#edit-sub-question-level2-form', async function (e) {
        e.preventDefault();
        var form_id = $("#form_id").val();
        var section_id = $("#section_id").val();
        var question_id = $("#question_id").val();
        var sub_question_id = $("#sub_question_id").val();
        var sub_question_id_level2 = $("#sub_question_id_level2").val();
        var submit_button_text = $("#custom-save-button").html();
        var form_data = new FormData(this);
        var form_url = `<?= route('superadmin.form.section.question.sub_question.view.manage.edit', ['id' => '__FORM_ID__', 'section_id' => '__SECTION_ID__', 'question_id' => '__QUESTION_ID__', 'sub_question_id' => '__SUB_QUESTION_ID__', 'sub_question_id_level2' => "__ID__"]) ?>`
            .replace('__QUESTION_ID__', question_id)
            .replace('__SECTION_ID__', section_id)
            .replace('__FORM_ID__', form_id)
            .replace('__ID__', sub_question_id_level2)
            .replace('__SUB_QUESTION_ID__', sub_question_id);


        const isSuccess = await saveFormDataAjax(form_data, form_url, submit_button_text);
        if (isSuccess == true) {
            manage_sub_question_level2(form_id, section_id, question_id, sub_question_id);
        }
    });


    $(document).on("click", "#delete-sub-question-level2", async function (event) {
        event.preventDefault();
        var sub_question_id_level2 = $(this).data('id');
        var form_id = $(this).attr('data-formId');
        var section_id = $(this).attr('data-sectionId');
        var question_id = $(this).attr('data-questionId');
        var sub_question_id = $(this).attr('data-subQuestionId');
        var form_url = `<?= route('superadmin.form.section.question.sub_question.view.manage.delete', ['id' => '__FORM_ID__', 'section_id' => '__SECTION_ID__', 'question_id' => '__QUESTION_ID__', 'sub_question_id' => '__SUB_QUESTION_ID__', 'sub_question_id_level2' => "__ID__"]) ?>`
            .replace('__QUESTION_ID__', question_id)
            .replace('__SECTION_ID__', section_id)
            .replace('__FORM_ID__', form_id)
            .replace('__ID__', sub_question_id_level2)
            .replace('__SUB_QUESTION_ID__', sub_question_id);
        try {
            let isSuccess = await deleteRecordViaAjax(form_url);
            if (isSuccess === true) {
                manage_sub_question_level2(form_id, section_id, question_id, sub_question_id);
            }
        } catch (error) {
            console.error("Error deleting base:", error);
        }
    });





    function mapQuestion(q, level, formId) {
        const questionNode = {
            name: `${q.question_text} (${q.question_type})`,
            isQuestion: true,
            children: [],
            actions: []
        };

        const sectionId = q.section_id;
        const questionId = q.parent_question_id || '';
        const subQuestionId = q.grandparent_question_id || '';

        if (level === 1) {
            questionNode.actions = [
                {
                    html: `<input type="checkbox" class="c-toggle-status" id="c-form-question-toggle"
                    data-id="${q.question_id}" data-formId="${formId}" data-sectionId="${sectionId}"
                    ${q.is_active == 1 ? 'checked' : ''}
                    data-toggle="toggle" data-on="Active" data-off="Inactive"
                    data-onstyle="success" data-offstyle="danger">`
                },
                {
                    html: `<a href="#" id="add-sub-question" data-id="${q.question_id}"
                    data-formId="${formId}" data-sectionId="${sectionId}"
                    class="btn btn-outline-primary btn-xs">
                    <i class="mdi mdi-plus-circle-outline"></i> Add Sub Question
                </a>`
                },
                {
                    html: `<a href="#" id="edit-question" data-id="${q.question_id}"
                    data-formId="${formId}" data-sectionId="${sectionId}"
                    class="btn btn-outline-secondary btn-xs"><i class="ti-pencil-alt"></i></a>`
                },
                {
                    html: `<a href="#" id="delete-question" data-id="${q.question_id}"
                    data-formId="${formId}" data-sectionId="${sectionId}"
                    class="btn btn-outline-danger btn-xs"><i class="ti-trash"></i></a>`
                }
            ];
        }

        if (level === 2) {
            questionNode.actions = [
                {
                    html: `<input type="checkbox" class="c-toggle-status" id="c-form-sub-question-toggle"
                    data-id="${q.question_id}" data-formId="${formId}" data-sectionId="${sectionId}"
                    data-questionId="${questionId}"
                    ${q.is_active == 1 ? 'checked' : ''}
                    data-toggle="toggle" data-on="Active" data-off="Inactive"
                    data-onstyle="success" data-offstyle="danger">`
                },
                {
                    html: `<a href="#" id="add-sub-question-level2" data-id="${q.question_id}"
                    data-questionId="${questionId}" data-formId="${formId}" data-sectionId="${sectionId}"
                    class="btn btn-outline-primary btn-xs">
                    <i class="mdi mdi-plus-circle-outline"></i> Add Sub Question
                </a>`
                },
                {
                    html: `<a href="#" id="edit-sub-question" data-id="${q.question_id}"
                    data-formId="${formId}" data-sectionId="${sectionId}" data-questionId="${questionId}"
                    class="btn btn-outline-secondary btn-xs"><i class="ti-pencil-alt"></i></a>`
                },
                {
                    html: `<a href="#" id="delete-sub-question" data-id="${q.question_id}"
                    data-formId="${formId}" data-sectionId="${sectionId}" data-questionId="${questionId}"
                    class="btn btn-outline-danger btn-xs"><i class="ti-trash"></i></a>`
                }
            ];
        }

        if (level === 3) {
            questionNode.actions = [
                {
                    html: `<input type="checkbox" class="c-toggle-status" id="c-form-sub-question-toggle"
                    data-id="${q.question_id}" data-formId="${formId}" data-sectionId="${sectionId}"
                    data-questionId="${questionId}" data-subQuestionId="${subQuestionId}"
                    ${q.is_active == 1 ? 'checked' : ''}
                    data-toggle="toggle" data-on="Active" data-off="Inactive"
                    data-onstyle="success" data-offstyle="danger">`
                },
                {
                    html: `<a href="#" id="edit-sub-question-level2" data-id="${q.question_id}"
                    data-formId="${formId}" data-sectionId="${sectionId}"
                    data-questionId="${questionId}" data-subQuestionId="${subQuestionId}"
                    class="btn btn-outline-secondary btn-xs"><i class="ti-pencil-alt"></i></a>`
                },
                {
                    html: `<a href="#" id="delete-sub-question-level2" data-id="${q.question_id}"
                    data-formId="${formId}" data-sectionId="${sectionId}"
                    data-questionId="${questionId}" data-subQuestionId="${subQuestionId}"
                    class="btn btn-outline-danger btn-xs"><i class="ti-trash"></i></a>`
                }
            ];
        }

        const opts = q.question_options || [];
        opts.forEach(opt => {
            const optNode = {
                name: opt.option_text,
                children: []
            };

            (opt.sub_questions || []).forEach(sub => {
                const subMapped = mapQuestion(sub, level + 1, formId);
                subMapped.parent_question_id = q.question_id;
                if (level === 2) {
                    subMapped.grandparent_question_id = q.parent_question_id || q.question_id;
                }
                optNode.children.push(subMapped);
            });

            optNode.name += ` (${optNode.children.length})`;
            questionNode.children.push(optNode);
        });

        questionNode.name += ` (${questionNode.children.length})`;
        return questionNode;
    }

    function buildTreeData(form) {
        return (form.sections || []).map(section => {
            const children = (section.questions || []).map(q => mapQuestion(q, 1, section.form_id));
            return {
                name: `${section.name} (${children.length})`,
                isSection: true,
                description: section.description || '',
                sectionId: section.section_id,
                formId: section.form_id,
                isActive: section.is_active == 1,
                children,
                actions: [
                    {
                        html: `<input type="checkbox" class="c-toggle-status" id="c-form-section-toggle"
                        data-id="${section.section_id}" data-formId="${section.form_id}"
                        ${section.is_active ? 'checked' : ''}
                        data-toggle="toggle" data-on="Active" data-off="Inactive"
                        data-onstyle="success" data-offstyle="danger">`
                    },
                    {
                        html: `<a href="#" id="add-form-section-questions" data-id="${section.section_id}" data-formId="${section.form_id}"
                        class="btn btn-outline-primary btn-xs"> <i class="mdi mdi-plus-circle-outline"></i> Add Question</a>`
                    },
                    {
                        html: `<a href="#" id="edit-form-section" data-formId="${section.form_id}"
                        data-id="${section.section_id}" class="btn btn-outline-secondary btn-xs">
                        <i class="ti-pencil-alt"></i></a>`
                    },
                    {
                        html: `<a href="#" id="delete-form-section" data-id="${section.section_id}"
                        data-formId="${section.form_id}" class="btn btn-outline-danger btn-xs">
                        <i class="ti-trash"></i></a>`
                    }
                ]
            };
        });
    }

    function renderTreeRecursive(data, parentElement, level) {
        data.forEach((item) => {
            const li = document.createElement('li');
            const hasChildren = Array.isArray(item.children) && item.children.length > 0;
            const icon = hasChildren ? '<i class="fas fa-chevron-right toggle-icon"></i>' : '';

            let actionHTML = '';
            (item.actions || []).forEach(btn => {
                if (btn.html) {
                    actionHTML += btn.html;
                } else {
                    actionHTML += `<button class="${btn.class}">${btn.text}</button>`;
                }
            });

            li.innerHTML = `
            <div class="tree-label ${level > 0 ? 'tree-node' : ''}">
                <span class="${hasChildren ? 'toggle-label' : ''}">
                    ${icon}
                    <strong>${item.name}</strong>
                </span>
                <div class="action-buttons">${actionHTML}</div>
            </div>
        `;

            if (hasChildren) {
                const nested = document.createElement('ul');
                nested.classList.add('nested', 'list-unstyled', 'tree-node');
                renderTreeRecursive(item.children, nested, level + 1);
                li.appendChild(nested);
            }

            parentElement.appendChild(li);
        });
    }

    function renderFormTree(formData) {
        document.getElementById("form-title").innerText = formData.name;
        document.getElementById("form-desc").innerText = formData.description;

        const treeData = buildTreeData(formData);
        const parentElement = document.getElementById("category-root");
        parentElement.innerHTML = '';

        treeData.forEach((item) => {
            const li = document.createElement('li');
            const hasChildren = Array.isArray(item.children) && item.children.length > 0;
            const icon = hasChildren ? '<i class="fas fa-chevron-right toggle-icon"></i>' : '';

            let actionHTML = '';
            (item.actions || []).forEach(btn => {
                if (btn.html) {
                    actionHTML += btn.html;
                } else {
                    actionHTML += `<button class="${btn.class}">${btn.text}</button>`;
                }
            });

            li.innerHTML = `
            <div class="tree-label">
                <span class="${hasChildren ? 'toggle-label' : ''}">
                    ${icon}
                    <strong class="section-title">${item.name}</strong>
                </span>
                <div class="action-buttons">${actionHTML}</div>
            </div>
            ${item.description ? `<div class="section-description ms-4 mb-2">${item.description}</div>` : ''}
        `;

            const nested = document.createElement('ul');
            nested.classList.add('nested', 'list-unstyled', 'tree-node');

            if (hasChildren) {
                renderTreeRecursive(item.children, nested, 1);
            }

            li.appendChild(nested);
            parentElement.appendChild(li);
        });

        applyToggleStatus();
        bindToggleLogic();
    }



    function bindToggleLogic() {
        document.getElementById("collapseAllBtn").addEventListener("click", () => {
            document.querySelectorAll("#category-root ul.nested").forEach(ul => ul.classList.remove("active"));
            document.querySelectorAll("#category-root .toggle-icon").forEach(icon => {
                icon.classList.remove("fa-chevron-down");
                icon.classList.add("fa-chevron-right");
            });
        });

        document.getElementById("category-root").addEventListener("click", function (e) {
            const toggleSpan = e.target.closest(".toggle-label");
            if (!toggleSpan) return;

            const li = toggleSpan.closest("li");
            const ul = li.querySelector(":scope > ul.nested");
            const icon = toggleSpan.querySelector("i");

            if (ul) {
                ul.classList.toggle("active");
                icon.classList.toggle("fa-chevron-down");
                icon.classList.toggle("fa-chevron-right");
            }
        });
        document.getElementById("searchInput").addEventListener("input", function () {
            const keyword = this.value.trim().toLowerCase();
            const rootElement = document.getElementById("category-root");

            if (!keyword) {
                document.querySelectorAll("#category-root li").forEach(li => {
                    li.style.display = "";
                });

                document.querySelectorAll("#category-root ul.nested").forEach(ul => {
                    ul.classList.remove("active");
                });

                document.querySelectorAll("#category-root .toggle-icon").forEach(icon => {
                    icon.classList.remove("fa-chevron-down");
                    icon.classList.add("fa-chevron-right");
                });

                document.querySelectorAll(".tree-highlight").forEach(el => {
                    el.classList.remove("tree-highlight");
                });
                document.getElementById("collapseAllBtn").click();
                return;
            }

            const allLi = rootElement.querySelectorAll("li");
            allLi.forEach(li => {
                li.style.display = "none";
                const nested = li.querySelector("ul.nested");
                if (nested) nested.classList.remove("active");
            });

            function showMatchAndAncestors(li) {
                li.style.display = "";

                // ✅ Show all children recursively
                const showAllDescendants = (node) => {
                    const nestedUl = node.querySelector(":scope > ul.nested");
                    if (nestedUl) {
                        nestedUl.classList.add("active");
                        const children = nestedUl.querySelectorAll(":scope > li");
                        children.forEach(child => {
                            child.style.display = "";
                            showAllDescendants(child); // 🔁 recurse into child
                        });

                        const icon = node.querySelector(".toggle-icon");
                        if (icon) {
                            icon.classList.add("fa-chevron-down");
                            icon.classList.remove("fa-chevron-right");
                        }
                    }
                };
                showAllDescendants(li);

                // ✅ Show ancestors
                let parent = li.parentElement.closest("li");
                while (parent) {
                    parent.style.display = "";
                    const nested = parent.querySelector(":scope > ul.nested");
                    if (nested) nested.classList.add("active");

                    const icon = parent.querySelector(".toggle-icon");
                    if (icon) {
                        icon.classList.add("fa-chevron-down");
                        icon.classList.remove("fa-chevron-right");
                    }

                    parent = parent.parentElement.closest("li");
                }
            }

            function searchAndReveal(li) {
                const strong = li.querySelector("strong");
                const desc = li.querySelector(".section-description");
                const text = ((strong?.textContent || '') + ' ' + (desc?.textContent || '')).toLowerCase();

                if (text.includes(keyword)) {
                    showMatchAndAncestors(li);
                    li.querySelector(".tree-label")?.classList.add("tree-highlight");
                } else {
                    li.querySelector(".tree-label")?.classList.remove("tree-highlight");
                }


                const children = li.querySelectorAll(":scope > ul > li");
                children.forEach(child => searchAndReveal(child));
            }

            const topLevelLis = rootElement.querySelectorAll("li");
            topLevelLis.forEach(li => searchAndReveal(li));
        });

    }



    function manage_departments() {
        dataUrl = "<?= route('superadmin.departments.manage') ?>";
        $.ajax({
            url: dataUrl,
            success: function (data) {
                $('#manage-department').html(data);
            }
        })
    }


    $(document).on("click", "#add-department", async function (event) {
        $("#custom-modal-title").text("Add Department");

        var data_url = "<?= route('superadmin.departments.manage.add') ?>";
        $.ajax({
            url: data_url,
            success: function (data) {
                $(".custom-modal").modal("show");
                $("#custom-modal-body").html(data);
            }
        })
    });

    $(document).on('submit', '#add-department-form', async function (e) {
        e.preventDefault();
        var submit_button_text = $("#custom-save-button").html();

        var form_data = new FormData(this);
        var form_url = "<?= route('superadmin.departments.manage.save') ?>";
        const isSuccess = await saveFormDataAjax(form_data, form_url, submit_button_text);
        if (isSuccess == true) {
            manage_departments();
        }
    })


    $(document).on('change', '#c-dept-form-toggle', async function (e) {
        e.preventDefault();
        var user_id = $(this).data('id');
        var status = $(this).prop('checked') ? 1 : 0;
        var form_url = "<?= route('superadmin.departments.manage.toggle-status') ?>";
        const data_to_send = new FormData();
        data_to_send.append('id', user_id);
        data_to_send.append('status', status);
        const isSuccess = await changeStatusToggle(form_url, data_to_send);
    });



    $(document).on("click", "#delete-department", async function (event) {
        event.preventDefault();
        var id = $(this).attr("data-id");
        var data_url = `<?= route('superadmin.departments.manage.delete', ['id' => '__ID__']) ?>`.replace('__ID__', id);
        try {
            let isSuccess = await deleteRecordViaAjax(data_url, '', 'GET');
            if (isSuccess === true) {
                manage_departments();
            }
        } catch (error) {
            console.error("Error deleting base:", error);
        }
    });

    $(document).on("click", "#edit-department", function () {
        event.preventDefault();
        var id = $(this).data("id");
        $("#custom-modal-title").text("Edit Department");
        var dataUrl = `<?= route('superadmin.departments.manage.edit', ['id' => '__ID__']) ?>`.replace('__ID__', id);
        $.ajax({
            url: dataUrl,
            success: function (data) {
                $(".custom-modal").modal("show");
                $("#custom-modal-body").html(data);
            }
        })
    });

    $(document).on('submit', '#edit-department-form', async function (e) {
        e.preventDefault();
        var id = $("#edit_id").val();
        var submit_button_text = $("#custom-save-button").html();
        var form_data = new FormData(this);
        var form_url = `<?= route('superadmin.departments.manage.update', ['id' => '__ID__']) ?>`.replace('__ID__', id);
        const isSuccess = await saveFormDataAjax(form_data, form_url, submit_button_text);
        if (isSuccess == true) {
            manage_departments();
        }
    });


    function manage_positions() {
        dataUrl = "<?= route('superadmin.positions.manage') ?>";
        $.ajax({
            url: dataUrl,
            success: function (data) {
                $('#manage-positions').html(data);
            }
        })
    }


    $(document).on("click", "#add-position", async function (event) {
        $("#custom-modal-title").text("Add position");

        var data_url = "<?= route('superadmin.positions.manage.add') ?>";
        $.ajax({
            url: data_url,
            success: function (data) {
                $(".custom-modal").modal("show");
                $("#custom-modal-body").html(data);
            }
        })
    });



    $(document).on('submit', '#add-position-form', async function (e) {
        e.preventDefault();
        var submit_button_text = $("#custom-save-button").html();

        var form_data = new FormData(this);
        var form_url = "<?= route('superadmin.positions.manage.save') ?>";
        const isSuccess = await saveFormDataAjax(form_data, form_url, submit_button_text);
        if (isSuccess == true) {
            manage_positions();
        }
    })


    $(document).on('change', '#c-position-form-toggle', async function (e) {
        e.preventDefault();
        var user_id = $(this).data('id');
        var status = $(this).prop('checked') ? 1 : 0;
        var form_url = "<?= route('superadmin.positions.manage.toggle-status') ?>";
        const data_to_send = new FormData();
        data_to_send.append('id', user_id);
        data_to_send.append('status', status);
        const isSuccess = await changeStatusToggle(form_url, data_to_send);
    });


    $(document).on("click", "#edit-position", function () {
        event.preventDefault();
        var id = $(this).data("id");
        $("#custom-modal-title").text("Edit Position");
        var dataUrl = `<?= route('superadmin.positions.manage.edit', ['id' => '__ID__']) ?>`.replace('__ID__', id);
        $.ajax({
            url: dataUrl,
            success: function (data) {
                $(".custom-modal").modal("show");
                $("#custom-modal-body").html(data);
            }
        })
    });



    $(document).on('submit', '#edit-position-form', async function (e) {
        e.preventDefault();
        var id = $("#edit_id").val();
        var submit_button_text = $("#custom-save-button").html();
        var form_data = new FormData(this);
        var form_url = `<?= route('superadmin.positions.manage.update', ['id' => '__ID__']) ?>`.replace('__ID__', id);
        const isSuccess = await saveFormDataAjax(form_data, form_url, submit_button_text);
        if (isSuccess == true) {
            manage_positions();
        }
    });


    $(document).on("click", "#delete-position", async function (event) {
        event.preventDefault();
        var id = $(this).attr("data-id");
        var data_url = `<?= route('superadmin.positions.manage.delete', ['id' => '__ID__']) ?>`.replace('__ID__', id);
        try {
            let isSuccess = await deleteRecordViaAjax(data_url, '', 'GET');
            if (isSuccess === true) {
                manage_positions();
            }
        } catch (error) {
            console.error("Error deleting base:", error);
        }
    });



    function manage_categories() {
        dataUrl = "<?= route('superadmin.categories.manage') ?>";
        $.ajax({
            url: dataUrl,
            success: function (data) {
                $('#manage-categories').html(data);
            }
        })
    }



    $(document).on("click", "#add-category", async function (event) {
        $("#custom-modal-title").text("Add Category");

        var data_url = "<?= route('superadmin.categories.manage.add') ?>";
        $.ajax({
            url: data_url,
            success: function (data) {
                $(".custom-modal").modal("show");
                $("#custom-modal-body").html(data);
            }
        })
    });


    $(document).on('submit', '#add-category-form', async function (e) {
        e.preventDefault();
        var submit_button_text = $("#custom-save-button").html();

        var form_data = new FormData(this);
        var form_url = "<?= route('superadmin.categories.manage.save') ?>";
        const isSuccess = await saveFormDataAjax(form_data, form_url, submit_button_text);
        if (isSuccess == true) {
            manage_categories();
        }
    })


    $(document).on("click", "#edit-category", function () {
        event.preventDefault();
        var id = $(this).data("id");
        $("#custom-modal-title").text("Edit Category");
        var dataUrl = `<?= route('superadmin.categories.manage.edit', ['id' => '__ID__']) ?>`.replace('__ID__', id);
        $.ajax({
            url: dataUrl,
            success: function (data) {
                $(".custom-modal").modal("show");
                $("#custom-modal-body").html(data);
            }
        })
    });


    $(document).on('submit', '#edit-category-form', async function (e) {
        e.preventDefault();
        var id = $("#edit_id").val();
        var submit_button_text = $("#custom-save-button").html();
        var form_data = new FormData(this);
        var form_url = `<?= route('superadmin.categories.manage.update', ['id' => '__ID__']) ?>`.replace('__ID__', id);
        const isSuccess = await saveFormDataAjax(form_data, form_url, submit_button_text);
        if (isSuccess == true) {
            manage_categories();
        }
    });

    $(document).on("click", "#delete-category", async function (event) {
        event.preventDefault();
        var id = $(this).attr("data-id");
        var data_url = `<?= route('superadmin.categories.manage.delete', ['id' => '__ID__']) ?>`.replace('__ID__', id);
        try {
            let isSuccess = await deleteRecordViaAjax(data_url, '', 'GET');
            if (isSuccess === true) {
                manage_categories();
            }
        } catch (error) {
            console.error("Error deleting base:", error);
        }
    });


    $(document).on("click", "#edit-template", async function (event) {
        $("#custom-modal-title").text("Edit Template");
        var id = $(this).attr("data-id");
        var data_url = `<?= route('superadmin.forms.manage.edit-template', ['id' => '__ID__']) ?>`.replace('__ID__', id);
        $.ajax({
            url: data_url,
            success: function (data) {
                $(".custom-modal").modal("show");
                $("#custom-modal-body").html(data);
            }
        })
    });


    $(document).on('submit', '#edit-template-form', async function (e) {
        e.preventDefault();
        var id = $("#edit_id").val();

        var submit_button_text = $("#custom-save-button").html();

        var form_data = new FormData(this);
        var form_url = `<?= route('superadmin.forms.manage.edit-template.update', ['id' => '__ID__']) ?>`.replace('__ID__', id);
        const isSuccess = await saveFormDataAjax(form_data, form_url, submit_button_text);
        if (isSuccess == true) {
            manageForms();
        }
    })
    

</script>