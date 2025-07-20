if (document.getElementById('data-list-1')) {
    const dataTableSearch = new simpleDatatables.DataTable("#data-list-1", {
      fixedHeight: false,
      perPage: 1000,
      perPageSelect: null,
      columns: [
        {
          select: 0,
            sort: "asc"
          }
        ]
    });

    document.querySelectorAll(".export").forEach(function(el) {
      el.addEventListener("click", function(e) {
        var type = el.dataset.type;

        var data = {
          type: type,
          filename: "soft-ui-" + type,
        };

        if (type === "csv") {
          data.columnDelimiter = "|";
        }

        dataTableSearch.export(data);
      });
    });
};

if (document.getElementById('data-list-usuarios')) {
    const dataTableSearch = new simpleDatatables.DataTable("#data-list-usuarios", {
      fixedHeight: false,
      perPage: 1000,
      perPageSelect: null,
      columns: [
        {
          select: 3,
            sort: "desc"
          }
        ]
    });

    document.querySelectorAll(".export").forEach(function(el) {
      el.addEventListener("click", function(e) {
        var type = el.dataset.type;

        var data = {
          type: type,
          filename: "soft-ui-" + type,
        };

        if (type === "csv") {
          data.columnDelimiter = "|";
        }

        dataTableSearch.export(data);
      });
    });
};

if (document.getElementById('feriados-list')) {
  const dataTableSearch = new simpleDatatables.DataTable("#feriados-list", {
    fixedHeight: false,
    perPage: 1000,
    perPageSelect: null,
    columns: [
        {
        select: 2,
        type: "date",
        format: "DD/MM/YYYY",
        sort: "desc"
        }
    ]
  });

  document.querySelectorAll(".export").forEach(function(el) {
    el.addEventListener("click", function(e) {
      var type = el.dataset.type;

      var data = {
        type: type,
        filename: "soft-ui-" + type,
      };

      if (type === "csv") {
        data.columnDelimiter = "|";
      }

      dataTableSearch.export(data);
    });
  });
};
