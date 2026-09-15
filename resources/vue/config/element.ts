import { ElAlert, ElButton, ElForm, ElTabs, ElRow } from 'element-plus'

// -----------------------------------
// alert
ElAlert.setPropsDefaults({
    closable: false,
    type: 'primary',
})

// -----------------------------------
// button
ElButton.setPropsDefaults({
    size: 'small',
})

// -----------------------------------
// button
ElRow.setPropsDefaults({
    gutter: 4,
})

// -----------------------------------
// form
ElForm.setPropsDefaults({
    labelPosition: 'top',
})

// -----------------------------------
ElTabs.setPropsDefaults({
    // type: 'border-card'
})

// -----------------------------------
// ...
