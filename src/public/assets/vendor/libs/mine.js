
jQuery(document).ready(function ($) {
  $('#data-table').DataTable({
    paging: true,
    searching: true,
    pageLength: 10,
    info: false,
    order: [],
    lengthMenu: [10, 50, 100],

  });
  $('#data-table').removeClass('dataTable');
  $('#data-table_filter').addClass('collapse');
  $('.select2').select2({
    width: '100%',
    dropdownParent: $('.modal'),
  });
  $(document).ready(function() {
    $('.modal-content').each(function() {
      var modal = $(this);
      modal.find('.select2').select2({
        width: '100%',
        dropdownParent: modal,
        responsive: true,
      });
    });
  $('#multiStepForm').parsley({
    language: 'fr',  // Set the language to French
        errors: {
            // Customize default messages as needed
            required: 'Ce champ est obligatoire.',
            type: 'Veuillez entrer une valeur valide.'
        }
  });

  });

  var currentStep = 1;

    // // Initialize Parsley with configuration
    // $('#multiStepForm').parsley({
    //     language: 'fr',  // Set the language to French
    //     errors: {
    //         // Customize default messages as needed
    //         required: 'Ce champ est obligatoire.',
    //         type: 'Veuillez entrer une valeur valide.'
    //     }
    // });

    function showStep(step) {
        $('.step').removeClass('active');
        $('.step').eq(step - 1).addClass('active');

        $('.step-pane').removeClass('active');
        $('#step' + step).addClass('active');
    }



    // Check on change
    $('#legal_form').on('change', function() {
        toggleStep5Visibility();
    });


    $('.next-btn').on('click', function() {
        var isValid = $('#multiStepForm').parsley().validate({ group: 'block-' + currentStep });

        if (isValid === true) {
            currentStep++;
            if (currentStep > 4) currentStep = 4;
            showStep(currentStep);
        }
    });

    $('.prev-btn').on('click', function() {
        currentStep--;
        if (currentStep < 1) currentStep = 1;
        showStep(currentStep);
    });

    $('.step-trigger').on('click', function(e) {
      e.preventDefault();
      const targetStep = $(this).data('step');

      if (targetStep < currentStep || $('#multiStepForm').parsley().validate({ group: 'block-' + currentStep })) {
          currentStep = targetStep;
          showStep(currentStep);
      }
  });

    showStep(currentStep);

    window.Parsley.addValidator('age', {
      validateString: function(value, requirement) {
          var birthDate = new Date(value);
          var today = new Date();
          var age = today.getFullYear() - birthDate.getFullYear();
          var m = today.getMonth() - birthDate.getMonth();
          if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
              age--;
          }
          return age >= requirement;
      },
      messages: {
          en: 'You must be at least %s years old.',
          fr: 'Le salarier doit avoir au moins %s ans.'
      }
  });

  window.Parsley.addValidator('aftertoday', {
      validateString: function(value) {
          var inputDate = new Date(value);
          var today = new Date();
          today.setHours(0, 0, 0, 0);
          return inputDate > today;
      },
      messages: {
          en: 'This date must be after today.',
          fr: 'La carte ne doit pas être expirée'
      }
  });


});
function printTable() {
  window.print();
}

function updateLabel(checkbox) {
  const id = checkbox.getAttribute('data-id');
  const label = document.getElementById(`label-for-checkbox-${id}`);

  if (checkbox.checked) {
    label.textContent = 'Pris';
  } else {
    label.textContent = 'Non Pris';
  }
}

document.addEventListener('DOMContentLoaded', function () {
  const checkboxes = document.querySelectorAll('.badge-checkbox');

  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function () {
      updateLabel(checkbox);
    });

    // Initial label update based on the checkbox state
    updateLabel(checkbox);
  });
});

function downloadCSV(name) {
  let table = document.getElementById('data-table');
  let rows = Array.from(table.rows);
  let csvContent = rows.map(row => {
    let cols = Array.from(row.cells).slice(0, -1); // Exclude the last cell
    return cols.map(col => col.innerText).join(',');
  }).join('\n');
  let csvBlob = new Blob([csvContent], { type: 'text/csv' });
  let link = document.createElement('a');
  link.href = URL.createObjectURL(csvBlob);
  link.download = name + '.csv';
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

function downloadExcel(name) {
  let table = document.getElementById('data-table');
  let rows = Array.from(table.rows);
  let xlsContent = rows.map(row => {
    let cols = Array.from(row.cells).slice(0, -1); // Exclude the last cell
    return `<tr>${cols.map(col => `<td>${col.innerText}</td>`).join('')}</tr>`;
  }).join('');
  let xlsBlob = new Blob([`<table>${xlsContent}</table>`], { type: 'application/vnd.ms-excel' });
  let link = document.createElement('a');
  link.href = URL.createObjectURL(xlsBlob);
  link.download = name + '.xls';
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

document.addEventListener('DOMContentLoaded', function() {
  const deleteForms = document.querySelectorAll('.delete-form');

  deleteForms.forEach(form => {
      form.addEventListener('submit', function(event) {
          event.preventDefault(); // Prevent the form from submitting

          const confirmDeletion = confirm('Voulez-vous vraiment supprimer cet élément ?');
          if (confirmDeletion) {
              form.submit(); // Submit the form if the user confirms
          }
      });
  });
});



// if you wanna get the full data from the datatable not the page
/*function downloadCSV(name) {
  var table = $('#data-table').DataTable();
  var data = table.rows({ search: 'applied' }).data().toArray(); // Get all data in the table
  var headers = table.columns().header().toArray().map(header => header.innerText).slice(0, -1);

  let csvContent = "data:text/csv;charset=utf-8,\uFEFF"; // Add BOM for UTF-8 encoding
  csvContent += headers.join(",") + "\n"; // Add headers

  data.forEach(function(row) {
      let rowData = row.slice(0, -1).map(cell => {
          // Create a temporary element to strip HTML tags
          let tempDiv = document.createElement("div");
          tempDiv.innerHTML = cell;
          return tempDiv.textContent || tempDiv.innerText || "";
      });
      csvContent += rowData.join(",") + "\n";
  });

  var encodedUri = encodeURI(csvContent);
  var link = document.createElement("a");
  link.setAttribute("href", encodedUri);
  link.setAttribute("download", name + '.csv');
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

function downloadExcel(name) {
var table = $('#data-table').DataTable();
var data = table.rows({ search: 'applied' }).data().toArray(); // Get all data in the table
var headers = table.columns().header().toArray().map(header => header.innerText).slice(0,-1);

let xlsContent = "<table><thead><tr>";
headers.forEach(header => {
    xlsContent += "<th>" + header + "</th>";
});
xlsContent += "</tr></thead><tbody>";

data.forEach(function(row) {
    let rowData = "<tr>";
    row.slice(0, -1).map(cell => {
        // Create a temporary element to strip HTML tags
        let tempDiv = document.createElement("div");
        tempDiv.innerHTML = cell;
        return tempDiv.textContent || tempDiv.innerText || "";
    }).forEach(text => {
        rowData += "<td>" + text + "</td>";
    });
    rowData += "</tr>";
    xlsContent += rowData;
});

xlsContent += "</tbody></table>";

var xlsBlob = new Blob([xlsContent], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8'  });
var link = document.createElement('a');
link.href = URL.createObjectURL(xlsBlob);
link.download = name + '.xls';
document.body.appendChild(link);
link.click();
document.body.removeChild(link);
}
*/



