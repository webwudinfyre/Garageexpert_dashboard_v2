(function () {
    "use strict";

    /**
     * Easy selector helper function
     */
    const select = (el, all = false) => {
        el = el.trim();
        if (all) {
            return [...document.querySelectorAll(el)];
        } else {
            return document.querySelector(el);
        }
    };
    /**
     * equiipments edit
     */
    const view_equip = document.getElementById("view_equip");

    if (view_equip) {
        view_equip.addEventListener("show.bs.modal", (event) => {
            // Button that triggered the modal
            const button = event.relatedTarget;
            // Extract info from data-bs-* attributes
            const recipient = button.getAttribute("data-bs-whatever");

            fetch("/admin/equipments_view/" + recipient, {
                method: "get",
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                    // Update the modal's content with data received from the server
                    const modalTitle = view_equip.querySelector(".modal-title");
                    const itemIDInput =
                        view_equip.querySelector("#floatingitem_id");
                    const brandInput =
                        view_equip.querySelector("#floatingBrand");
                    const modelInput =
                        view_equip.querySelector("#floatingModel");
                    const addressTextarea =
                        view_equip.querySelector("#floatingTextarea");
                    const itemID = view_equip.querySelector("#recipient_name");

                    modalTitle.textContent = "Equipment Edit";

                    itemID.value = data.data.id;
                    itemIDInput.value = data.data.item_id;
                    brandInput.value = data.data.Brand;
                    modelInput.value = data.data.Model;
                    addressTextarea.value = data.data.Item_name;
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        });
    }

    /**
     * view_details product
     */

    /**
     * view_details taken_by
     */

    const taken_by = document.getElementById("taken_by");

    if (taken_by) {
        taken_by.addEventListener("show.bs.modal", (event) => {
            const button = event.relatedTarget;
            const recipient = button.getAttribute("data-bs-whatever");

            fetch("/tech/joballocation/job_view/" + recipient, {
                method: "get",
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);

                    const Office_Name = document.querySelector("#Office_Name");
                    const Location_Name =
                        document.querySelector("#Location_Name");
                    const Email = document.querySelector("#Email");
                    const Phone_Number =
                        document.querySelector("#Phone_Number");
                    const Product_Code =
                        document.querySelector("#Product_Code");
                    const Brand_Name = document.querySelector("#Brand_Name");
                    const Model = document.querySelector("#Model");
                    const Product_Name =
                        document.querySelector("#Product_Name");
                    const pdt_id_name = document.querySelector("#pdt_id_name");

                    Office_Name.textContent =
                        data.product_add.client_pdt.office;
                    Location_Name.textContent =
                        data.product_add.client_pdt.location;
                    Email.textContent = data.product_add.client_pdt.users.email;
                    Phone_Number.textContent =
                        data.product_add.client_pdt.phonenumber;

                    Product_Code.textContent = data.product_add.product_code;
                    Brand_Name.textContent = data.product_add.equip_pdt.Brand;
                    Model.textContent = data.product_add.equip_pdt.Model;
                    Product_Name.textContent =
                        data.product_add.client_pdt.phonenumber;
                    pdt_id_name.value = data.id;
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        });
    }
    /**
     * view_details assign
     */

    const assign_to = document.getElementById("assign_to");

    if (assign_to) {
        assign_to.addEventListener("show.bs.modal", (event) => {
            const button = event.relatedTarget;
            const recipient = button.getAttribute("data-bs-whatever");

            fetch("/tech/joballocation/job_view/" + recipient, {
                method: "get",
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);

                    const Office_Name = document.querySelector(
                        "#Office_Name_assign"
                    );
                    const Location_Name = document.querySelector(
                        "#Location_Name_assign"
                    );
                    const Email = document.querySelector("#Email_assign");
                    const Phone_Number = document.querySelector(
                        "#Phone_Number_assign"
                    );
                    const Product_Code = document.querySelector(
                        "#Product_Code_assign"
                    );
                    const Brand_Name =
                        document.querySelector("#Brand_Name_assign");
                    const Model = document.querySelector("#Model_assign");
                    const Product_Name = document.querySelector(
                        "#Product_Name_assign"
                    );
                    const pdt_id_name = document.querySelector(
                        "#pdt_id_name_assign"
                    );

                    Office_Name.textContent =
                        data.product_add.client_pdt.office;
                    Location_Name.textContent =
                        data.product_add.client_pdt.location;
                    Email.textContent = data.product_add.client_pdt.users.email;
                    Phone_Number.textContent =
                        data.product_add.client_pdt.phonenumber;

                    Product_Code.textContent = data.product_add.product_code;
                    Brand_Name.textContent = data.product_add.equip_pdt.Brand;
                    Model.textContent = data.product_add.equip_pdt.Model;
                    Product_Name.textContent =
                        data.product_add.equip_pdt.Item_name;
                    pdt_id_name.value = data.id;
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        });
    }
    /**
     * taskViewModal
     */
    const download_button = document.getElementById("download_button");

    if (download_button) {
        download_button.addEventListener("click", function () {
            alert("Button clicked!");
        });
    }
   /**
     * taskViewModal1
     */

   const taskViewModal2 = document.getElementById("taskViewModal2");

   if (taskViewModal2) {
    taskViewModal2.addEventListener("show.bs.modal", (event) => {
           const button = event.relatedTarget;
           const recipient = button.getAttribute("data-bs-whatever");

           fetch("/client/report/prdct_view_task/" + recipient, {
               method: "get",
           })
               .then((response) => response.json())
               .then((data) => {
                   console.log(data);

                   // Access the table body
                   const tableBody = document.querySelector(
                       "#admin_table_task_view tbody"
                   );

                   // Clear existing rows
                   tableBody.innerHTML = "";
                   let slNumber = 1;
                   // Loop through the data and populate the table
                   data.forEach((item) => {
                       const startDate = new Date(item.date_of_schedule);
                       const endDate = new Date(item.updated_at);
                       const dateDifference = Math.ceil(
                           (endDate - startDate) / (1000 * 60 * 60 * 24)
                       );

                       // Create a new row
                       const row = document.createElement("tr");

                       // Create cells for type_services_id, admin_id, and service_name

                       const slNumberCell = document.createElement("td");
                       slNumberCell.textContent = slNumber++;
                       slNumberCell.style.textAlign = "center"; // Align text to the left
                       row.appendChild(slNumberCell);

                       const serviceNameCell = document.createElement("td");
                       serviceNameCell.textContent =
                           item.type_service.service_name;
                       serviceNameCell.style.textAlign = "left"; // Align text to the left
                       row.appendChild(serviceNameCell);

                       const adminIdCell = document.createElement("td");
                       adminIdCell.textContent = item.users_pdt.name;
                       adminIdCell.style.textAlign = "left"; // Align text to the left
                       row.appendChild(adminIdCell);

                       const timeTakkenCell = document.createElement("td");
                       // Create a list element to hold the start and end dates and the difference
                       const list = document.createElement("ul");
                       // Set the list style to align left
                       list.style.textAlign = "left";
                       // Append list items for start date, end date, and difference
                       const startDateListItem = document.createElement("li");
                       startDateListItem.textContent =
                           "Start date: " + startDate.toLocaleDateString();
                       list.appendChild(startDateListItem);

                       const endDateListItem = document.createElement("li");
                       endDateListItem.textContent =
                           "End date: " + endDate.toLocaleDateString();
                       list.appendChild(endDateListItem);

                       let differenceDescription = "";
                       if (dateDifference === 0) {
                           differenceDescription = "on date";
                       } else if (dateDifference > 0) {
                           differenceDescription =
                               "late by " + dateDifference + " days";
                       } else {
                           differenceDescription =
                               "early by " +
                               Math.abs(dateDifference) +
                               " days";
                       }

                       const differenceListItem = document.createElement("li");
                       differenceListItem.textContent =
                           "Difference: " + differenceDescription;
                       list.appendChild(differenceListItem);

                       // Append the list to the timeTakkenCell
                       timeTakkenCell.appendChild(list);
                       timeTakkenCell.style.textAlign = "left"; // Align text to the left
                       row.appendChild(timeTakkenCell);

                       const status = document.createElement("td");
                       status.textContent = item.task.task_name;
                       status.style.textAlign = "left"; // Align text to the left
                       row.appendChild(status);

                       const actionCell = document.createElement("td");
                       actionCell.style.textAlign = "left"; // Align text to the left

                       // Create a div to hold the icons
                       const iconsDiv = document.createElement("div");
                       iconsDiv.style.display = "flex"; // Use flexbox to align icons horizontally
                       iconsDiv.style.gap = "10px"; // Add some space between icons

                       // Construct the HTML for the view button with tooltip
                       const viewButtonHtml = `
                               <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View" href="/client/report/task_list_view/${item.product_id}">
                                   <button type="button" class="btn">
                                       <i class="bi bi-eye"></i>
                                   </button>
                               </a>
                           `;

                       // Set the HTML for the view button
                       iconsDiv.innerHTML += viewButtonHtml;

                       // Check if the task is complete
                       if (item.task_id === 4) {
                           // Construct the HTML for the download button
                           const downloadButtonHtml = `
                               <a href="/client/report/taskpdfdowmload/${item.id}">
                                   <button type="button" class="btn">
                                       <i class="bi bi-download"></i>
                                   </button>
                               </a>
                           `;

                           // Set the HTML for the download button
                           iconsDiv.innerHTML += downloadButtonHtml;
                       } else {
                           // Construct the HTML for the progress bar
                           const progressBarHtml = `

                               <button type="button" class="btn">
                               <i class="bi bi-hourglass-split"></i>
                           </button>

                           `;

                           // Set the HTML for the progress bar
                           iconsDiv.innerHTML += progressBarHtml;
                       }

                       // Append the icons div to the action cell
                       actionCell.appendChild(iconsDiv);

                       // Append the action cell to the row
                       row.appendChild(actionCell);
                       // Append the row to the table body
                       tableBody.appendChild(row);
                   });
               })
               .catch((error) => {
                   console.error("Error:", error);
               });
       });
   }
    /**
     * taskViewModal
     */

    const taskViewModal = document.getElementById("taskViewModal");

    if (taskViewModal) {
        taskViewModal.addEventListener("show.bs.modal", (event) => {
            const button = event.relatedTarget;
            const recipient = button.getAttribute("data-bs-whatever");

            fetch("/admin/report/prdct_view_task/" + recipient, {
                method: "get",
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);

                    // Access the table body
                    const tableBody = document.querySelector(
                        "#admin_table_task_view tbody"
                    );

                    // Clear existing rows
                    tableBody.innerHTML = "";
                    let slNumber = 1;
                    // Loop through the data and populate the table
                    data.forEach((item) => {
                        const startDate = new Date(item.date_of_schedule);
                        const endDate = new Date(item.updated_at);
                        const dateDifference = Math.ceil(
                            (endDate - startDate) / (1000 * 60 * 60 * 24)
                        );

                        // Create a new row
                        const row = document.createElement("tr");

                        // Create cells for type_services_id, admin_id, and service_name

                        const slNumberCell = document.createElement("td");
                        slNumberCell.textContent = slNumber++;
                        slNumberCell.style.textAlign = "center"; // Align text to the left
                        row.appendChild(slNumberCell);

                        const serviceNameCell = document.createElement("td");
                        serviceNameCell.textContent =
                            item.type_service.service_name;
                        serviceNameCell.style.textAlign = "left"; // Align text to the left
                        row.appendChild(serviceNameCell);

                        const adminIdCell = document.createElement("td");
                        adminIdCell.textContent = item.users_pdt.name;
                        adminIdCell.style.textAlign = "left"; // Align text to the left
                        row.appendChild(adminIdCell);

                        const timeTakkenCell = document.createElement("td");
                        // Create a list element to hold the start and end dates and the difference
                        const list = document.createElement("ul");
                        // Set the list style to align left
                        list.style.textAlign = "left";
                        // Append list items for start date, end date, and difference
                        const startDateListItem = document.createElement("li");
                        startDateListItem.textContent =
                            "Start date: " + startDate.toLocaleDateString();
                        list.appendChild(startDateListItem);

                        const endDateListItem = document.createElement("li");
                        endDateListItem.textContent =
                            "End date: " + endDate.toLocaleDateString();
                        list.appendChild(endDateListItem);

                        let differenceDescription = "";
                        if (dateDifference === 0) {
                            differenceDescription = "on date";
                        } else if (dateDifference > 0) {
                            differenceDescription =
                                "late by " + dateDifference + " days";
                        } else {
                            differenceDescription =
                                "early by " +
                                Math.abs(dateDifference) +
                                " days";
                        }

                        const differenceListItem = document.createElement("li");
                        differenceListItem.textContent =
                            "Difference: " + differenceDescription;
                        list.appendChild(differenceListItem);

                        // Append the list to the timeTakkenCell
                        timeTakkenCell.appendChild(list);
                        timeTakkenCell.style.textAlign = "left"; // Align text to the left
                        row.appendChild(timeTakkenCell);

                        const status = document.createElement("td");
                        status.textContent = item.task.task_name;
                        status.style.textAlign = "left"; // Align text to the left
                        row.appendChild(status);

                        const actionCell = document.createElement("td");
                        actionCell.style.textAlign = "left"; // Align text to the left

                        // Create a div to hold the icons
                        const iconsDiv = document.createElement("div");
                        iconsDiv.style.display = "flex"; // Use flexbox to align icons horizontally
                        iconsDiv.style.gap = "10px"; // Add some space between icons

                        // Construct the HTML for the view button with tooltip
                        const viewButtonHtml = `
                                <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View" href="/admin/report/task_list_view/${item.product_id}">
                                    <button type="button" class="btn">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </a>
                            `;

                        // Set the HTML for the view button
                        iconsDiv.innerHTML += viewButtonHtml;

                        // Check if the task is complete
                        if (item.task_id === 4) {
                            // Construct the HTML for the download button
                            const downloadButtonHtml = `
                                <a href="/admin/report/taskpdfdowmload/${item.id}">
                                    <button type="button" class="btn">
                                        <i class="bi bi-download"></i>
                                    </button>
                                </a>
                            `;

                            // Set the HTML for the download button
                            iconsDiv.innerHTML += downloadButtonHtml;
                        } else {
                            // Construct the HTML for the progress bar
                            const progressBarHtml = `

                                <button type="button" class="btn">
                                <i class="bi bi-hourglass-split"></i>
                            </button>

                            `;

                            // Set the HTML for the progress bar
                            iconsDiv.innerHTML += progressBarHtml;
                        }

                        // Append the icons div to the action cell
                        actionCell.appendChild(iconsDiv);

                        // Append the action cell to the row
                        row.appendChild(actionCell);
                        // Append the row to the table body
                        tableBody.appendChild(row);
                    });
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        });
    }
    /**
     * Quotation_aproval
     */

    const Quotation_aproval = document.getElementById("Quotation_aproval");

    if (Quotation_aproval) {
        Quotation_aproval.addEventListener("show.bs.modal", (event) => {
            const button = event.relatedTarget;
            const recipient = button.getAttribute("data-bs-whatever");

            fetch("/admin/joballocation/job_view/" + recipient, {
                method: "get",
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);

                    const Office_Name = document.querySelector(
                        "#Office_Name_assign"
                    );
                    const Location_Name = document.querySelector(
                        "#Location_Name_assign"
                    );
                    const Email = document.querySelector("#Email_assign");
                    const Phone_Number = document.querySelector(
                        "#Phone_Number_assign"
                    );
                    const Product_Code = document.querySelector(
                        "#Product_Code_assign"
                    );
                    const Brand_Name =
                        document.querySelector("#Brand_Name_assign");
                    const Model = document.querySelector("#Model_assign");
                    const Product_Name = document.querySelector(
                        "#Product_Name_assign"
                    );
                    const pdt_id_name = document.querySelector(
                        "#pdt_id_name_assign"
                    );

                    Office_Name.textContent =
                        data.product_add.client_pdt.office;
                    Location_Name.textContent =
                        data.product_add.client_pdt.location;
                    Email.textContent = data.product_add.client_pdt.users.email;
                    Phone_Number.textContent =
                        data.product_add.client_pdt.phonenumber;

                    Product_Code.textContent = data.product_add.product_code;
                    Brand_Name.textContent = data.product_add.equip_pdt.Brand;
                    Model.textContent = data.product_add.equip_pdt.Model;
                    Product_Name.textContent =
                        data.product_add.equip_pdt.Item_name;
                    pdt_id_name.value = data.id;
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        });
    }
    /**
     * view_details assign_job
     */

    //    const assign_to_job_button = document.getElementById("assign_to_job_button");
    //    const assign_to_job_modal = document.getElementById("assign_to_job_modal");

    //    if (assign_to_job_button && assign_to_job_modal) {
    //        assign_to_job_button.addEventListener("click", () => {
    //            fetch("/tech/joballocation/job_view/" + recipient, {
    //                method: "get",
    //            })
    //            .then((response) => response.json())
    //            .then((data) => {
    //                console.log(data);

    //                const Office_Name = document.querySelector("#Office_Name_assign_job");
    //                const Location_Name = document.querySelector("#Location_Name_assign_job");
    //                const Email = document.querySelector("#Email_assign_job");
    //                const Phone_Number= document.querySelector("#Phone_Number_assign_job");
    //                const Product_Code= document.querySelector("#Product_Code_assign_job");
    //                const Brand_Name= document.querySelector("#Brand_Name_assign_job");
    //                const Model= document.querySelector("#Model_assign_job");
    //                const Product_Name= document.querySelector("#Product_Name_assign_job");
    //                const pdt_id_name= document.querySelector("#pdt_id_name_assign_job");

    //             //    Office_Name.textContent = data.product_add.client_pdt.office;
    //             //    Location_Name.textContent = data.product_add.client_pdt.location;
    //             //    Email.textContent = data.product_add.client_pdt.users.email;
    //             //    Phone_Number.textContent = data.product_add.client_pdt.phonenumber;

    //                Product_Code.textContent = data.product_add.product_code;
    //                Brand_Name.textContent = data.product_add.equip_pdt.Brand;
    //                Model.textContent = data.product_add.equip_pdt.Model;
    //             //    Product_Name.textContent = data.product_add.client_pdt.product_name; // Corrected typo
    //                pdt_id_name.value = data.id; // Setting value property for input field
    //            })
    //            .catch((error) => {
    //                console.error("Error:", error);
    //            });
    //        });
    //    }

    /**
     * view_details product
     */
    const view_details = document.getElementById("view_details");

    if (view_details) {
        view_details.addEventListener("show.bs.modal", (event) => {
            const button = event.relatedTarget;
            const recipient = button.getAttribute("data-bs-whatever");

            fetch("/admin/joballocation/job_list_view", {
                method: "get",
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                    const id = data;
                    const brandInput =
                        view_details.querySelector("#floatingModel");
                    brandInput.value = id;
                    document.getElementById("demo").innerHTML = `${id}`;
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        });
    }

    /**
     * delet conformation
     */

    const view_delete = document.getElementById("view_delete");

    if (view_delete) {
        view_delete.addEventListener("show.bs.modal", (event) => {
            // Button that triggered the modal
            const button = event.relatedTarget;
            // Extract info from data-bs-* attributes
            const recipient = button.getAttribute("data-bs-whatever");

            fetch("/admin/equipments_view/" + recipient, {
                method: "get",
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                    // Update the modal's content with data received from the server
                    const modalTitle =
                        view_delete.querySelector(".modal-title");
                    const itemID = view_delete.querySelector("#Item_ID");
                    const brand = view_delete.querySelector("#Brand");
                    const model = view_delete.querySelector("#Model");
                    const itemName = view_delete.querySelector("#Item_Name");

                    const id = view_delete.querySelector("#recipient_name");

                    modalTitle.textContent = "Confirm equipment deletion?";
                    id.value = data.data.id;
                    itemID.textContent = data.data.item_id;
                    brand.textContent = data.data.Brand;
                    model.textContent = data.data.Model;
                    itemName.textContent = data.data.Item_name;
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        });
    }

    /**
     * Password_change function
     */
    const Password_change = document.getElementById("Password_change");
    if (Password_change) {
        Password_change.addEventListener("show.bs.modal", (event) => {
            // Button that triggered the modal
            const button = event.relatedTarget;
            // Extract info from data-bs-* attributes
            const recipient = button.getAttribute("data-bs-whatever");

            fetch("/admin/passwordchange/" + recipient, {
                method: "get",
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                    // Update the modal's content with data received from the server
                    const modalTitle =
                        Password_change.querySelector(".modal-title");
                    const emailInput =
                        Password_change.querySelector("#floatingEmail");
                    const nameInput =
                        Password_change.querySelector("#floatingName");
                    const modalBodyInput =
                        Password_change.querySelector("#recipient-name");

                    modalBodyInput.value = recipient;
                    modalTitle.textContent = "Password Change";
                    emailInput.value = data.data.email;
                    nameInput.value = data.data.name;
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        });
    }

    const Password_change_api = document.getElementById("Password_change_api");
    if (Password_change_api) {
        Password_change_api.addEventListener("show.bs.modal", (event) => {
            // Button that triggered the modal
            const button = event.relatedTarget;
            // Extract info from data-bs-* attributes
            const recipient = button.getAttribute("data-bs-whatever");

            fetch("/client/passwordchange/" + recipient, {
                method: "get",
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                    // Update the modal's content with data received from the server
                    const modalTitle =
                        Password_change_api.querySelector(".modal-title");
                    const emailInput =
                        Password_change_api.querySelector("#floatingEmail");
                    const nameInput =
                        Password_change_api.querySelector("#floatingName");
                    const modalBodyInput =
                        Password_change_api.querySelector("#recipient-name");

                    modalBodyInput.value = recipient;
                    modalTitle.textContent = "Password Change";
                    emailInput.value = data.data.email;
                    nameInput.value = data.data.name;
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        });
    }

    /**
     *  Status_change function
     */
    const Status_change = document.getElementById("Status_change");
    if (Status_change) {
        Status_change.addEventListener("show.bs.modal", (event) => {
            // Button that triggered the modal
            const button = event.relatedTarget;
            // Extract info from data-bs-* attributes
            const recipient = button.getAttribute("data-bs-whatever");

            fetch("/admin/passwordchange/" + recipient, {
                method: "get",
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                    // Update the modal's content with data received from the server
                    const modalTitle =
                        Status_change.querySelector(".modal-title");
                    const emailInput =
                        Status_change.querySelector("#floatingEmail");
                    const nameInput =
                        Status_change.querySelector("#floatingName");
                    const StatusInput =
                        Status_change.querySelector("#statusName");
                    const modalBodyInput =
                        Status_change.querySelector("#recipient-name");

                    modalBodyInput.value = recipient;
                    modalTitle.textContent = "Status Change";
                    emailInput.value = data.data.email;
                    nameInput.value = data.data.name;
                    const status1 = data.data.status;

                    // Update the status input based on the received status value
                    if (status1 === "1") {
                        StatusInput.value = "Active";
                    } else if (status1 === "2") {
                        StatusInput.value = "Inactive";
                    }

                    // Populate the dropdown with the received status value
                    populateDropdown(data.data.status);
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        });
    }
    const Status_change_client = document.getElementById(
        "Status_change_client"
    );
    if (Status_change_client) {
        Status_change_client.addEventListener("show.bs.modal", (event) => {
            // Button that triggered the modal
            const button = event.relatedTarget;
            // Extract info from data-bs-* attributes
            const recipient = button.getAttribute("data-bs-whatever");

            fetch("/client/passwordchange/" + recipient, {
                method: "get",
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                    // Update the modal's content with data received from the server
                    const modalTitle =
                        Status_change_client.querySelector(".modal-title");
                    const emailInput =
                        Status_change_client.querySelector("#floatingEmail");
                    const nameInput =
                        Status_change_client.querySelector("#floatingName");
                    const StatusInput =
                        Status_change_client.querySelector("#statusName");
                    const modalBodyInput =
                        Status_change_client.querySelector("#recipient-name");

                    modalBodyInput.value = recipient;
                    modalTitle.textContent = "Status Change";
                    emailInput.value = data.data.email;
                    nameInput.value = data.data.name;
                    const status1 = data.data.status;

                    // Update the status input based on the received status value
                    if (status1 === "1") {
                        StatusInput.value = "Active";
                    } else if (status1 === "2") {
                        StatusInput.value = "Inactive";
                    }

                    // Populate the dropdown with the received status value
                    populateDropdown(data.data.status);
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        });
    }

    function populateDropdown(status) {
        var dropdown = $("#myDropdown");
        // Clear previous dropdown options
        dropdown.empty();

        // Add options for "Active" and "Inactive"
        dropdown.append(
            $("<option>", {
                value: 1,
                text: "Active",
                selected: status === 1,
            })
        );
        dropdown.append(
            $("<option>", {
                value: 2,
                text: "Inactive",
                selected: status === 2,
            })
        );
    }

    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = false) => {
        if (all) {
            select(el, all).forEach((e) => e.addEventListener(type, listener));
        } else {
            select(el, all).addEventListener(type, listener);
        }
    };

    /**
     * Easy on scroll event listener
     */
    const onscroll = (el, listener) => {
        el.addEventListener("scroll", listener);
    };

    /**
     * Sidebar toggle
     */
    if (select(".toggle-sidebar-btn")) {
        on("click", ".toggle-sidebar-btn", function (e) {
            select("body").classList.toggle("toggle-sidebar");
        });
    }

    /**
     * Search bar toggle
     */
    if (select(".search-bar-toggle")) {
        on("click", ".search-bar-toggle", function (e) {
            select(".search-bar").classList.toggle("search-bar-show");
        });
    }

    /**
     * Navbar links active state on scroll
     */
    let navbarlinks = select("#navbar .scrollto", true);
    const navbarlinksActive = () => {
        let position = window.scrollY + 200;
        navbarlinks.forEach((navbarlink) => {
            if (!navbarlink.hash) return;
            let section = select(navbarlink.hash);
            if (!section) return;
            if (
                position >= section.offsetTop &&
                position <= section.offsetTop + section.offsetHeight
            ) {
                navbarlink.classList.add("active");
            } else {
                navbarlink.classList.remove("active");
            }
        });
    };
    window.addEventListener("load", navbarlinksActive);
    onscroll(document, navbarlinksActive);

    /**
     * Toggle .header-scrolled class to #header when page is scrolled
     */
    let selectHeader = select("#header");
    if (selectHeader) {
        const headerScrolled = () => {
            if (window.scrollY > 100) {
                selectHeader.classList.add("header-scrolled");
            } else {
                selectHeader.classList.remove("header-scrolled");
            }
        };
        window.addEventListener("load", headerScrolled);
        onscroll(document, headerScrolled);
    }

    /**
     * Back to top button
     */
    let backtotop = select(".back-to-top");
    if (backtotop) {
        const toggleBacktotop = () => {
            if (window.scrollY > 100) {
                backtotop.classList.add("active");
            } else {
                backtotop.classList.remove("active");
            }
        };
        window.addEventListener("load", toggleBacktotop);
        onscroll(document, toggleBacktotop);
    }

    /**
     * Initiate tooltips
     */
    var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    /**
     * Initiate quill editors
     */
    if (select(".quill-editor-default")) {
        new Quill(".quill-editor-default", {
            theme: "snow",
        });
    }

    if (select(".quill-editor-bubble")) {
        new Quill(".quill-editor-bubble", {
            theme: "bubble",
        });
    }

    if (select(".quill-editor-full")) {
        new Quill(".quill-editor-full", {
            modules: {
                toolbar: [
                    [
                        {
                            font: [],
                        },
                        {
                            size: [],
                        },
                    ],
                    ["bold", "italic", "underline", "strike"],
                    [
                        {
                            color: [],
                        },
                        {
                            background: [],
                        },
                    ],
                    [
                        {
                            script: "super",
                        },
                        {
                            script: "sub",
                        },
                    ],
                    [
                        {
                            list: "ordered",
                        },
                        {
                            list: "bullet",
                        },
                        {
                            indent: "-1",
                        },
                        {
                            indent: "+1",
                        },
                    ],
                    [
                        "direction",
                        {
                            align: [],
                        },
                    ],
                    ["link", "image", "video"],
                    ["clean"],
                ],
            },
            theme: "snow",
        });
    }

    /**
     * Initiate TinyMCE Editor
     */
    const useDarkMode = window.matchMedia(
        "(prefers-color-scheme: dark)"
    ).matches;
    const isSmallScreen = window.matchMedia("(max-width: 1023.5px)").matches;

    tinymce.init({
        selector: "textarea.tinymce-editor",
        plugins:
            "preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons",
        editimage_cors_hosts: ["picsum.photos"],
        menubar: "file edit view insert format tools table help",
        toolbar:
            "undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl",
        toolbar_sticky: true,
        toolbar_sticky_offset: isSmallScreen ? 102 : 108,
        autosave_ask_before_unload: true,
        autosave_interval: "30s",
        autosave_prefix: "{path}{query}-{id}-",
        autosave_restore_when_empty: false,
        autosave_retention: "2m",
        image_advtab: true,
        link_list: [
            {
                title: "My page 1",
                value: "https://www.tiny.cloud",
            },
            {
                title: "My page 2",
                value: "http://www.moxiecode.com",
            },
        ],
        image_list: [
            {
                title: "My page 1",
                value: "https://www.tiny.cloud",
            },
            {
                title: "My page 2",
                value: "http://www.moxiecode.com",
            },
        ],
        image_class_list: [
            {
                title: "None",
                value: "",
            },
            {
                title: "Some class",
                value: "class-name",
            },
        ],
        importcss_append: true,
        file_picker_callback: (callback, value, meta) => {
            /* Provide file and text for the link dialog */
            if (meta.filetype === "file") {
                callback("https://www.google.com/logos/google.jpg", {
                    text: "My text",
                });
            }

            /* Provide image and alt text for the image dialog */
            if (meta.filetype === "image") {
                callback("https://www.google.com/logos/google.jpg", {
                    alt: "My alt text",
                });
            }

            /* Provide alternative source and posted for the media dialog */
            if (meta.filetype === "media") {
                callback("movie.mp4", {
                    source2: "alt.ogg",
                    poster: "https://www.google.com/logos/google.jpg",
                });
            }
        },
        templates: [
            {
                title: "New Table",
                description: "creates a new table",
                content:
                    '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>',
            },
            {
                title: "Starting my story",
                description: "A cure for writers block",
                content: "Once upon a time...",
            },
            {
                title: "New list with dates",
                description: "New List with dates",
                content:
                    '<div class="mceTmpl"><span class="cdate">cdate</span><br><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>',
            },
        ],
        template_cdate_format: "[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]",
        template_mdate_format: "[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]",
        height: 600,
        image_caption: true,
        quickbars_selection_toolbar:
            "bold italic | quicklink h2 h3 blockquote quickimage quicktable",
        noneditable_class: "mceNonEditable",
        toolbar_mode: "sliding",
        contextmenu: "link image table",
        skin: useDarkMode ? "oxide-dark" : "oxide",
        content_css: useDarkMode ? "dark" : "default",
        content_style:
            "body { font-family:Helvetica,Arial,sans-serif; font-size:16px }",
    });

    /**
     * Initiate Bootstrap validation check
     */
    var needsValidation = document.querySelectorAll(".needs-validation");

    Array.prototype.slice.call(needsValidation).forEach(function (form) {
        form.addEventListener(
            "submit",
            function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add("was-validated");
            },
            false
        );
    });

    /**
     * Initiate Datatables
     */
    const datatables = select(".datatable", true);
    datatables.forEach((datatable) => {
        new simpleDatatables.DataTable(datatable, {
            perPageSelect: [5, 10, 15, ["All", -1]],
            columns: [
                {
                    select: 2,
                    sortSequence: ["desc", "asc"],
                },
                {
                    select: 3,
                    sortSequence: ["desc"],
                },
                {
                    select: 4,
                    cellClass: "green",
                    headerClass: "red",
                },
            ],
        });
    });

    /**
     * Autoresize echart charts
     */
    const mainContainer = select("#main");
    if (mainContainer) {
        setTimeout(() => {
            new ResizeObserver(function () {
                select(".echart", true).forEach((getEchart) => {
                    echarts.getInstanceByDom(getEchart).resize();
                });
            }).observe(mainContainer);
        }, 200);
    }
    document.addEventListener("DOMContentLoaded", function () {
        var tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                placement: "top",
                trigger: "manual", // Set trigger to manual
            });
        });

        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            tooltipTriggerEl.addEventListener("mouseenter", function () {
                var tooltip = bootstrap.Tooltip.getInstance(tooltipTriggerEl);
                tooltip.show();
            });

            tooltipTriggerEl.addEventListener("mouseleave", function () {
                var tooltip = bootstrap.Tooltip.getInstance(tooltipTriggerEl);
                tooltip.hide();
            });
        });
    });
})();
