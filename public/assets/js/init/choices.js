if (document.getElementById('choices-1')) {
  var element = document.getElementById('choices-1');
  new Choices(element, {
    searchEnabled: true,
    placeholder: true,
    searchPlaceholderValue: null,
  });
};

if (document.getElementById('choices-basic')) {
    var element = document.getElementById('choices-basic');
    new Choices(element, {
      searchEnabled: true,
      placeholder: true,
      searchPlaceholderValue: null,
      position: 'auto'
    });
  };

  if (document.getElementById('choices-basic-2')) {
      var element = document.getElementById('choices-basic-2');
      new Choices(element, {
          searchEnabled: true,
          placeholder: true,
          searchPlaceholderValue: 'Digite aqui...',
          position: 'auto',
          shouldSort: false,
      });
  };

if (document.getElementById('choices-basic-3')) {
    var element3 = document.getElementById('choices-basic-3');
    new Choices(element3, {
        placeholder: true,
        searchEnabled: true,
        searchPlaceholderValue: 'Digite aqui...',
        position: 'auto',
        shouldSort: false,
    });
};

if (document.getElementById('choices-2')) {
  var element = document.getElementById('choices-2');
  new Choices(element, {
    searchEnabled: true,
    placeholder: true,
    searchPlaceholderValue: null,
  });
};

if (document.getElementById('choices-3')) {
  var element = document.getElementById('choices-3');
  new Choices(element, {
    searchEnabled: true,
    placeholder: true,
    searchPlaceholderValue: null,
  });
};

if (document.getElementById('choices-4')) {
  var element = document.getElementById('choices-4');
  new Choices(element, {
    searchEnabled: true,
    placeholder: true,
    searchPlaceholderValue: null,
  });
};

if (document.getElementById('choices-5')) {
  var element = document.getElementById('choices-5');
  new Choices(element, {
    searchEnabled: true,
    placeholder: true,
    searchPlaceholderValue: null,
  });
};

  if (document.getElementById('choices-6')) {
    var element = document.getElementById('choices-6');
    new Choices(element, {
      searchEnabled: false
    });
  };

  if (document.getElementById('choices-7')) {
    var element = document.getElementById('choices-7');
    new Choices(element, {
      searchEnabled: false
    });
  };

  if (document.getElementById('choices-tags-1')) {
    var tags = document.getElementById('choices-tags-1');
    const examples = new Choices(tags, {
      removeItemButton: true,
      searchEnabled: true,
      searchChoices: true,
      searchFields: ['label'],
    });
  }

  if (document.getElementById('choices-tags-2')) {
    var tags = document.getElementById('choices-tags-2');
    const examples = new Choices(tags, {
      removeItemButton: true,
      searchEnabled: true,
      searchChoices: true,
      searchFields: ['label'],
    });
  }

  if (document.getElementById('choices-tags-3')) {
    console.log('choices-tags-3');
    var tags = document.getElementById('choices-tags-3');
    const examples = new Choices(tags, {
      removeItemButton: true,
      searchEnabled: true,
      searchChoices: true,
      searchFields: ['label'],
    });
  }

  if (document.getElementById('choices-tags-4')) {
    var tags = document.getElementById('choices-tags-4');
    const examples = new Choices(tags, {
      removeItemButton: true,
      searchEnabled: true,
      searchChoices: true,
      searchFields: ['label'],
    });
  }

  if (document.getElementById('choices-tags-5')) {
    var tags = document.getElementById('choices-tags-4');
    const examples = new Choices(tags, {
      removeItemButton: true,
      searchEnabled: true,
      searchChoices: true,
      searchFields: ['label'],
    });
  }

  if (document.getElementById('choices-tags-6')) {
    var tags = document.getElementById('choices-tags-4');
    const examples = new Choices(tags, {
      removeItemButton: true,
      searchEnabled: true,
      searchChoices: true,
      searchFields: ['label'],
    });
  }

  if (document.getElementById('choices-tags-7')) {
    var tags = document.getElementById('choices-tags-4');
    const examples = new Choices(tags, {
      removeItemButton: true,
      searchEnabled: true,
      searchChoices: true,
      searchFields: ['label'],
    });
  }

  if (document.getElementById('choices-tags-8')) {
    var tags = document.getElementById('choices-tags-4');
    const examples = new Choices(tags, {
      removeItemButton: true,
      searchEnabled: true,
      searchChoices: true,
      searchFields: ['label'],
    });
  }

  if (document.getElementById('choices-tags-9')) {
    var tags = document.getElementById('choices-tags-4');
    const examples = new Choices(tags, {
      removeItemButton: true,
      searchEnabled: true,
      searchChoices: true,
      searchFields: ['label'],
    });
  }

  if (document.getElementById('choices-tags-10')) {
    var tags = document.getElementById('choices-tags-4');
    const examples = new Choices(tags, {
      removeItemButton: true,
      searchEnabled: true,
      searchChoices: true,
      searchFields: ['label'],
    });
  }

  if (document.getElementById('choices-select-1')) {
    var tags = document.getElementById('choices-select-1');
    const examples = new Choices(select, {
      removeItemButton: true,
      searchEnabled: true,
      searchChoices: true,
      searchFields: ['label'],
    });
  }
